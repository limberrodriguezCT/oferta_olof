<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterMatriculasRequest;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaEstadoRequest;
use App\Models\Carrera;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MatriculaController extends Controller
{
    public function index(): View
    {
        $carreras = Carrera::withCount([
            'matriculas',
            'matriculas as no_vistas_count' => fn (Builder $query) => $query->where('vista', false),
        ])->orderByDesc('anio_academico')->orderBy('nombre')->get();

        $archivadas = Matricula::whereNull('carrera_id')
            ->select('carrera_nombre', 'anio_academico')
            ->selectRaw('COUNT(*) as matriculas_count')
            ->selectRaw('SUM(CASE WHEN vista = 0 THEN 1 ELSE 0 END) as no_vistas_count')
            ->groupBy('carrera_nombre', 'anio_academico')
            ->orderBy('carrera_nombre')->get();

        return view('matriculas.index', compact('carreras', 'archivadas'));
    }

    public function listado(FilterMatriculasRequest $request): View
    {
        $filtros = $request->validated();
        $query = Matricula::query();
        if (! empty($filtros['carrera_id'])) {
            $carrera = Carrera::findOrFail($filtros['carrera_id']);
            $query->where('carrera_id', $carrera->id);
            $nombre = $carrera->nombre;
            $anio = $carrera->anio_academico;
            $grupo = ['carrera_id' => $carrera->id];
        } else {
            $nombre = $filtros['nombre'];
            $anio = $filtros['anio'];
            $query->whereNull('carrera_id')->where('carrera_nombre', $nombre)->where('anio_academico', $anio);
            $grupo = ['nombre' => $nombre, 'anio' => $anio];
        }

        foreach (preg_split('/\s+/u', trim($filtros['q'] ?? ''), -1, PREG_SPLIT_NO_EMPTY) as $termino) {
            $query->where(function (Builder $busqueda) use ($termino): void {
                foreach (['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'documento_identidad', 'telefono_celular', 'correo'] as $campo) {
                    $busqueda->orWhereLike($campo, '%'.$termino.'%');
                }
            });
        }
        if (! empty($filtros['desde'])) {
            $query->whereDate('fecha_matricula', '>=', $filtros['desde']);
        }
        if (! empty($filtros['hasta'])) {
            $query->whereDate('fecha_matricula', '<=', $filtros['hasta']);
        }
        if (! empty($filtros['estado'])) {
            $query->where('estado', $filtros['estado']);
        }
        if (isset($filtros['vista'])) {
            $query->where('vista', (bool) $filtros['vista']);
        }
        match ($filtros['orden'] ?? 'recientes') {
            'nombre' => $query->orderBy('primer_nombre')->orderBy('primer_apellido')->orderBy('id'),
            'antiguas' => $query->orderBy('fecha_matricula')->orderBy('id'),
            default => $query->orderByDesc('fecha_matricula')->orderByDesc('id'),
        };
        $matriculas = $query->paginate(20)->withQueryString();
        $estados = Matricula::ESTADOS;

        return view('matriculas.listado', compact('matriculas', 'nombre', 'anio', 'grupo', 'filtros', 'estados'));
    }

    public function update(UpdateMatriculaEstadoRequest $request, Matricula $matricula): RedirectResponse
    {
        $matricula->vista = $request->boolean('vista');
        $matricula->estado = $request->validated('estado');
        $matricula->save();

        return back()->with('success', 'Seguimiento de matrícula actualizado.');
    }

    public function show(Matricula $matricula): Response
    {
        return response()->view('matriculas.print', compact('matricula'))
            ->header('Cache-Control', 'private, no-store');
    }

    public function create(): View
    {
        $carreras = Carrera::where('anio_academico', 2027)->orderBy('nombre')->get();

        return view('matriculas.create', compact('carreras'));
    }

    public function store(StoreMatriculaRequest $request): RedirectResponse
    {
        $datos = $request->validated();
        $carrera = Carrera::findOrFail($datos['carrera_id']);

        Matricula::create(array_merge($datos, [
            'carrera_nombre' => $carrera->nombre,
            'anio_academico' => $carrera->anio_academico,
            'centro_tecnologico' => 'Centro Tecnológico Olof Palme',
            'fecha_matricula' => now('America/Managua')->toDateString(),
        ]));

        return redirect()->route('matriculas.create')->with('matricula_success', 'Su formulario de matrícula ha sido recibido. El centro se comunicará con usted para confirmar el proceso.');
    }
}
