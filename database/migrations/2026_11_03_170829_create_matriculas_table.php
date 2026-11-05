<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrera_id')->nullable()->constrained('carreras')->nullOnDelete();
            $table->string('carrera_nombre');
            $table->unsignedSmallInteger('anio_academico');
            $table->string('centro_tecnologico');
            $table->date('fecha_matricula');
            $table->boolean('becado_anteriormente');
            $table->date('fecha_nacimiento');
            $table->string('nacionalidad');
            $table->string('documento_identidad')->nullable();
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('sexo');
            $table->string('estado_civil')->nullable();
            $table->string('municipio_nacimiento');
            $table->string('etnia')->nullable();
            $table->string('departamento_domicilio');
            $table->string('municipio_domicilio');
            $table->text('direccion_domicilio');
            $table->string('area');
            $table->string('comunidad')->nullable();
            $table->string('telefono_celular');
            $table->string('telefono_domiciliar')->nullable();
            $table->unsignedSmallInteger('personas_hogar')->nullable();
            $table->string('correo')->nullable();
            $table->string('profesion_oficio')->nullable();
            $table->string('nivel_academico');
            $table->unsignedSmallInteger('anio_egreso_bachillerato')->nullable();
            $table->string('modalidad_bachillerato')->nullable();
            $table->string('idiomas')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('tipo_sangre')->nullable();
            $table->boolean('trabaja_actualmente');
            $table->string('empresa')->nullable();
            $table->string('departamento_trabajo')->nullable();
            $table->string('municipio_trabajo')->nullable();
            $table->text('direccion_trabajo')->nullable();
            $table->string('telefono_trabajo')->nullable();
            $table->string('cargo')->nullable();
            $table->string('emergencia_nombre');
            $table->string('emergencia_parentesco');
            $table->text('emergencia_direccion')->nullable();
            $table->string('emergencia_telefono');
            $table->string('departamento_curso')->nullable();
            $table->string('municipio_curso')->nullable();
            $table->string('comunidad_curso')->nullable();
            $table->string('escuela')->nullable();
            $table->string('programa_estrategia')->nullable();
            $table->string('turno');
            $table->json('documentos')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
