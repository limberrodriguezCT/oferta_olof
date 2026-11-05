<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matricula extends Model
{
    public const ESTADOS = [
        'pendiente' => 'Pendiente',
        'en_revision' => 'En revisión',
        'revisada' => 'Revisada',
        'requiere_correccion' => 'Requiere corrección',
        'confirmada' => 'Confirmada',
        'cancelada' => 'Cancelada',
    ];

    protected $fillable = [
        'carrera_id',
        'carrera_nombre',
        'anio_academico',
        'centro_tecnologico',
        'fecha_matricula',
        'becado_anteriormente',
        'fecha_nacimiento',
        'nacionalidad',
        'documento_identidad',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'sexo',
        'estado_civil',
        'municipio_nacimiento',
        'etnia',
        'departamento_domicilio',
        'municipio_domicilio',
        'direccion_domicilio',
        'area',
        'comunidad',
        'telefono_celular',
        'telefono_domiciliar',
        'personas_hogar',
        'correo',
        'profesion_oficio',
        'nivel_academico',
        'anio_egreso_bachillerato',
        'modalidad_bachillerato',
        'idiomas',
        'discapacidad',
        'tipo_sangre',
        'trabaja_actualmente',
        'empresa',
        'departamento_trabajo',
        'municipio_trabajo',
        'direccion_trabajo',
        'telefono_trabajo',
        'cargo',
        'emergencia_nombre',
        'emergencia_parentesco',
        'emergencia_direccion',
        'emergencia_telefono',
        'departamento_curso',
        'municipio_curso',
        'comunidad_curso',
        'escuela',
        'programa_estrategia',
        'turno',
        'documentos',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'fecha_matricula' => 'date',
            'becado_anteriormente' => 'boolean',
            'trabaja_actualmente' => 'boolean',
            'documentos' => 'array',
            'vista' => 'boolean',
        ];
    }

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }
}
