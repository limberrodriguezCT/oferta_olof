<?php

namespace Tests\Feature;

use App\Models\Carrera;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatriculaTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_form_lists_current_courses_and_preselects_the_requested_course(): void
    {
        $carrera = Carrera::factory()->create(['nombre' => 'Curso disponible']);
        Carrera::factory()->create(['nombre' => 'Curso anterior', 'anio_academico' => 2026]);

        $this->get(route('matriculas.create', ['carrera_id' => $carrera->id]))
            ->assertOk()
            ->assertSee('Curso disponible')
            ->assertDontSee('Curso anterior')
            ->assertSee('value="'.$carrera->id.'" selected', false)
            ->assertSee('Datos laborales')
            ->assertDontSee('Documentos presentados')
            ->assertDontSee('name="turno"', false)
            ->assertDontSee('name="departamento_curso"', false)
            ->assertDontSee('name="municipio_curso"', false)
            ->assertDontSee('name="comunidad_curso"', false)
            ->assertDontSee('name="escuela"', false)
            ->assertDontSee('name="programa_estrategia"', false);
    }

    public function test_empty_catalog_explains_that_enrollment_is_unavailable(): void
    {
        $this->get(route('matriculas.create'))->assertOk()
            ->assertSee('Aún no hay especialidades disponibles')
            ->assertDontSee('Enviar formulario de matrícula');
    }

    public function test_public_submission_saves_enrollment_and_ignores_untrusted_metadata(): void
    {
        $this->travelTo(now()->setDate(2026, 11, 3)->setTime(18, 0));
        $carrera = Carrera::factory()->create(['nombre' => 'Curso de prueba']);
        $payload = array_merge($this->validPayload($carrera), [
            'documentos' => ['fotocopia_cedula', 'fotografia'],
            'turno' => 'Matutino',
            'departamento_curso' => 'Esteli',
            'centro_tecnologico' => 'Otro centro',
            'estado' => 'confirmada',
            'vista' => true,
            'anio_academico' => 2030,
            'fecha_matricula' => '2030-01-01',
        ]);

        $this->post(route('matriculas.store'), $payload)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('matriculas.create'))
            ->assertSessionHas('matricula_success');

        $this->assertDatabaseHas('matriculas', [
            'primer_nombre' => 'Ana', 'carrera_id' => $carrera->id,
            'carrera_nombre' => 'Curso de prueba', 'anio_academico' => 2027,
            'centro_tecnologico' => 'Centro Tecnológico Olof Palme',
        ]);
        $matricula = Matricula::firstOrFail();
        $this->assertSame('2026-11-03', $matricula->fecha_matricula->format('Y-m-d'));
        $this->assertNull($matricula->documentos);
        $this->assertNull($matricula->turno);
        $this->assertNull($matricula->departamento_curso);
        $this->assertFalse($matricula->becado_anteriormente);
        $this->assertFalse($matricula->vista);
        $this->assertSame('pendiente', $matricula->estado);
    }

    public function test_missing_required_fields_do_not_create_an_enrollment(): void
    {
        $this->from(route('matriculas.create'))->post(route('matriculas.store'), [])
            ->assertRedirect(route('matriculas.create'))
            ->assertSessionHasErrors([
                'primer_nombre' => 'Este campo es obligatorio.',
                'carrera_id' => 'Este campo es obligatorio.',
                'emergencia_telefono' => 'Este campo es obligatorio.',
            ]);

        $this->assertDatabaseCount('matriculas', 0);
    }

    public function test_previous_academic_year_cannot_receive_enrollments(): void
    {
        $carrera = Carrera::factory()->create(['anio_academico' => 2026]);

        $this->post(route('matriculas.store'), $this->validPayload($carrera))
            ->assertSessionHasErrors(['carrera_id' => 'Seleccione una especialidad disponible para 2027.']);

        $this->assertDatabaseCount('matriculas', 0);
    }

    public function test_invalid_personal_data_is_rejected_and_input_is_retained(): void
    {
        $carrera = Carrera::factory()->create();
        $payload = array_merge($this->validPayload($carrera), [
            'fecha_nacimiento' => '2999-01-01', 'correo' => 'invalid',
            'area' => 'Otra',
        ]);

        $this->from(route('matriculas.create'))->post(route('matriculas.store'), $payload)
            ->assertSessionHasErrors(['fecha_nacimiento', 'correo', 'area'])
            ->assertSessionHasInput('primer_nombre', 'Ana');

        $this->assertDatabaseCount('matriculas', 0);
    }

    public function test_deleting_a_course_preserves_enrollment_history(): void
    {
        $carrera = Carrera::factory()->create(['nombre' => 'Curso archivado']);
        $this->post(route('matriculas.store'), $this->validPayload($carrera))->assertSessionHasNoErrors();

        $carrera->delete();

        $this->assertDatabaseHas('matriculas', ['carrera_id' => null, 'carrera_nombre' => 'Curso archivado']);
    }

    public function test_guest_cannot_list_or_print_enrollments(): void
    {
        $this->get(route('matriculas.index'))->assertRedirect(route('login'));
        $this->get(route('matriculas.print', 1))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_list_enrollments_and_open_print_links(): void
    {
        $carrera = Carrera::factory()->create(['nombre' => 'Carrera para imprimir']);
        $this->post(route('matriculas.store'), $this->validPayload($carrera))->assertSessionHasNoErrors();
        $matricula = Matricula::firstOrFail();

        $this->actingAs(User::factory()->create())->get(route('matriculas.listado', ['carrera_id' => $carrera->id]))
            ->assertOk()->assertSee('Ana')->assertSee('Carrera para imprimir')
            ->assertSee(route('matriculas.print', $matricula));
    }

    public function test_print_sheet_contains_saved_data_and_original_paper_sections(): void
    {
        $carrera = Carrera::factory()->create(['nombre' => 'Carrera archivada']);
        $this->post(route('matriculas.store'), $this->validPayload($carrera))->assertSessionHasNoErrors();
        $matricula = Matricula::firstOrFail();
        $carrera->delete();

        $response = $this->actingAs(User::factory()->create())->get(route('matriculas.print', $matricula));

        $response->assertOk()->assertSee('HOJA DE MATRICULA 2027')
            ->assertSee('Ana')->assertSee('15/06/2005')->assertSee('Carrera archivada')
            ->assertSee('DATOS LABORALES')->assertSee('DOCUMENTOS PRESENTADOS')
            ->assertSee('FIRMA DEL PROTAGONISTA')->assertSee('FIRMA DE REGISTRO')
            ->assertSee('window.print()', false);
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_print_sheet_escapes_participant_input(): void
    {
        $carrera = Carrera::factory()->create();
        $payload = array_merge($this->validPayload($carrera), ['primer_nombre' => '<script>alert(1)</script>']);
        $this->post(route('matriculas.store'), $payload)->assertSessionHasNoErrors();

        $this->actingAs(User::factory()->create())->get(route('matriculas.print', Matricula::firstOrFail()))
            ->assertOk()->assertSee('<script>alert(1)</script>')->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_printing_a_missing_enrollment_returns_not_found(): void
    {
        $this->actingAs(User::factory()->create())->get(route('matriculas.print', 999))->assertNotFound();
    }

    public function test_overview_shows_course_counts_including_empty_courses_without_participant_rows(): void
    {
        $carrera = Carrera::factory()->create(['nombre' => 'Electricidad']);
        $vacia = Carrera::factory()->create(['nombre' => 'Mecanica']);
        $this->registrar($carrera, ['primer_nombre' => 'ParticipantePrivado']);
        $vista = $this->registrar($carrera);
        $vista->vista = true;
        $vista->save();

        $response = $this->actingAs(User::factory()->create())->get(route('matriculas.index'));

        $response->assertOk()->assertSee('Electricidad')->assertSee('Mecanica')->assertDontSee('ParticipantePrivado');
        $carreras = $response->viewData('carreras')->keyBy('id');
        $this->assertSame(2, $carreras[$carrera->id]->matriculas_count);
        $this->assertSame(1, $carreras[$carrera->id]->no_vistas_count);
        $this->assertSame(0, $carreras[$vacia->id]->matriculas_count);
    }

    public function test_course_filters_combine_full_name_dates_state_and_read_status_without_leaking_other_courses(): void
    {
        $carrera = Carrera::factory()->create();
        $otra = Carrera::factory()->create();
        $selected = $this->registrar($carrera, ['primer_nombre' => 'Ana', 'primer_apellido' => 'Gomez', 'fecha_matricula' => '2026-11-03']);
        $this->registrar($carrera, ['primer_nombre' => 'Pedro']);
        $this->registrar($otra, ['primer_nombre' => 'Ana', 'primer_apellido' => 'Gomez']);
        $this->registrar($carrera, ['primer_nombre' => 'Ana', 'primer_apellido' => 'Gomez', 'fecha_matricula' => '2026-10-01']);

        $response = $this->actingAs(User::factory()->create())->get(route('matriculas.listado', [
            'carrera_id' => $carrera->id, 'q' => 'Ana Gomez', 'desde' => '2026-11-03',
            'hasta' => '2026-11-03', 'estado' => 'pendiente', 'vista' => '0',
        ]));

        $response->assertOk();
        $this->assertSame([$selected->id], $response->viewData('matriculas')->pluck('id')->all());
    }

    public function test_archived_courses_keep_separate_lists_after_deletion(): void
    {
        $primera = Carrera::factory()->create(['nombre' => 'Carrera eliminada A']);
        $segunda = Carrera::factory()->create(['nombre' => 'Carrera eliminada B']);
        $selected = $this->registrar($primera);
        $this->registrar($segunda);
        $primera->delete();
        $segunda->delete();

        $this->actingAs(User::factory()->create())->get(route('matriculas.index'))
            ->assertOk()->assertSee('Carrera eliminada A')->assertSee('Carrera eliminada B');
        $response = $this->get(route('matriculas.listado', ['nombre' => 'Carrera eliminada A', 'anio' => 2027]));

        $response->assertOk();
        $this->assertSame([$selected->id], $response->viewData('matriculas')->pluck('id')->all());
    }

    public function test_follow_up_can_be_marked_seen_reviewed_and_then_unseen_pending(): void
    {
        $matricula = $this->registrar(Carrera::factory()->create());
        $url = route('matriculas.listado', ['carrera_id' => $matricula->carrera_id, 'q' => 'Ana']);
        $this->actingAs(User::factory()->create())->from($url)
            ->patch(route('matriculas.update', $matricula), ['vista' => '1', 'estado' => 'revisada', 'primer_nombre' => 'Alterado'])
            ->assertSessionHasNoErrors()->assertRedirect($url);

        $matricula->refresh();
        $this->assertTrue($matricula->vista);
        $this->assertSame('revisada', $matricula->estado);
        $this->assertSame('Ana', $matricula->primer_nombre);

        $this->patch(route('matriculas.update', $matricula), ['vista' => '0', 'estado' => 'pendiente'])->assertSessionHasNoErrors();
        $this->assertFalse($matricula->fresh()->vista);
        $this->assertSame('pendiente', $matricula->fresh()->estado);
    }

    public function test_guests_cannot_access_course_lists_or_change_follow_up(): void
    {
        $matricula = $this->registrar(Carrera::factory()->create());

        $this->get(route('matriculas.listado', ['carrera_id' => $matricula->carrera_id]))->assertRedirect(route('login'));
        $this->patch(route('matriculas.update', $matricula), ['vista' => '1', 'estado' => 'confirmada'])->assertRedirect(route('login'));

        $this->assertFalse($matricula->fresh()->vista);
        $this->assertSame('pendiente', $matricula->fresh()->estado);
    }

    public function test_invalid_follow_up_values_are_rejected_without_updating_the_record(): void
    {
        $matricula = $this->registrar(Carrera::factory()->create());

        $this->actingAs(User::factory()->create())->patch(route('matriculas.update', $matricula), ['vista' => 'invalid', 'estado' => 'invalid'])
            ->assertSessionHasErrors(['vista', 'estado']);

        $this->assertFalse($matricula->fresh()->vista);
        $this->assertSame('pendiente', $matricula->fresh()->estado);
    }

    public function test_invalid_date_range_and_filter_values_are_rejected(): void
    {
        $carrera = Carrera::factory()->create();

        $this->actingAs(User::factory()->create())->get(route('matriculas.listado', [
            'carrera_id' => $carrera->id, 'desde' => '2026-11-04', 'hasta' => '2026-11-01',
            'estado' => 'invalid', 'vista' => 'invalid', 'orden' => 'invalid',
        ]))->assertSessionHasErrors(['hasta', 'estado', 'vista', 'orden']);
    }

    public function test_pagination_retains_course_filters_and_orders_by_name(): void
    {
        $carrera = Carrera::factory()->create();
        for ($i = 1; $i <= 21; $i++) {
            $this->registrar($carrera, ['primer_nombre' => 'Alumno '.str_pad((string) $i, 2, '0', STR_PAD_LEFT)]);
        }

        $response = $this->actingAs(User::factory()->create())->get(route('matriculas.listado', ['carrera_id' => $carrera->id, 'q' => 'Alumno', 'orden' => 'nombre']));

        $response->assertOk();
        $paginator = $response->viewData('matriculas');
        $this->assertSame(21, $paginator->total());
        $this->assertSame('Alumno 01', $paginator->first()->primer_nombre);
        $this->assertStringContainsString('q=Alumno', $paginator->nextPageUrl());
        $this->assertStringContainsString('carrera_id='.$carrera->id, $paginator->nextPageUrl());
    }

    private function registrar(Carrera $carrera, array $overrides = []): Matricula
    {
        return Matricula::create(array_merge($this->validPayload($carrera), [
            'carrera_nombre' => $carrera->nombre, 'anio_academico' => $carrera->anio_academico,
            'centro_tecnologico' => 'Olof Palme', 'fecha_matricula' => '2026-11-03',
        ], $overrides))->refresh();
    }

    private function validPayload(Carrera $carrera): array
    {
        return [
            'carrera_id' => $carrera->id, 'becado_anteriormente' => '0',
            'fecha_nacimiento' => '2005-06-15', 'nacionalidad' => 'Nicaraguense',
            'primer_nombre' => 'Ana', 'primer_apellido' => 'Perez', 'sexo' => 'Femenino',
            'municipio_nacimiento' => 'Esteli', 'departamento_domicilio' => 'Esteli',
            'municipio_domicilio' => 'Esteli', 'direccion_domicilio' => 'Barrio central',
            'area' => 'Urbana', 'telefono_celular' => '88888888',
            'nivel_academico' => 'Bachiller', 'trabaja_actualmente' => '0',
            'emergencia_nombre' => 'Maria Perez', 'emergencia_parentesco' => 'Madre',
            'emergencia_telefono' => '77777777',
        ];
    }
}
