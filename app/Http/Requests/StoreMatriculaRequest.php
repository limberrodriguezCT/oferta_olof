<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMatriculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'carrera_id' => ['required', 'integer', Rule::exists('carreras', 'id')->where('anio_academico', 2027)],
            'becado_anteriormente' => 'required|boolean',
            'fecha_nacimiento' => 'required|date|before:today',
            'nacionalidad' => 'required|string|max:255',
            'documento_identidad' => 'nullable|string|max:255',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'sexo' => 'required|string|max:255|in:Femenino,Masculino',
            'estado_civil' => 'nullable|string|max:255|in:Soltero/a,Casado/a,Unión de hecho estable,Divorciado/a,Viudo/a',
            'municipio_nacimiento' => 'required|string|max:255',
            'etnia' => 'nullable|string|max:255',
            'departamento_domicilio' => 'required|string|max:255',
            'municipio_domicilio' => 'required|string|max:255',
            'direccion_domicilio' => 'required|string|max:2000',
            'area' => 'required|string|max:255|in:Urbana,Rural',
            'comunidad' => 'nullable|string|max:255',
            'telefono_celular' => 'required|string|max:30',
            'telefono_domiciliar' => 'nullable|string|max:30',
            'personas_hogar' => 'nullable|integer|min:1|max:1000',
            'correo' => 'nullable|email|max:255',
            'profesion_oficio' => 'nullable|string|max:255',
            'nivel_academico' => 'required|string|max:255',
            'anio_egreso_bachillerato' => 'nullable|integer|min:1900|max:2027',
            'modalidad_bachillerato' => 'nullable|string|max:255|in:Bachillerato en el campo,Otras modalidades,No aplica',
            'idiomas' => 'nullable|string|max:255',
            'discapacidad' => 'nullable|string|max:255',
            'tipo_sangre' => 'nullable|string|max:255|in:A+,A-,B+,B-,AB+,AB-,O+,O-,Desconocido',
            'trabaja_actualmente' => 'required|boolean',
            'empresa' => 'nullable|string|max:255',
            'departamento_trabajo' => 'nullable|string|max:255',
            'municipio_trabajo' => 'nullable|string|max:255',
            'direccion_trabajo' => 'nullable|string|max:2000',
            'telefono_trabajo' => 'nullable|string|max:30',
            'cargo' => 'nullable|string|max:255',
            'emergencia_nombre' => 'required|string|max:255',
            'emergencia_parentesco' => 'required|string|max:255',
            'emergencia_direccion' => 'nullable|string|max:2000',
            'emergencia_telefono' => 'required|string|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Este campo es obligatorio.',
            'carrera_id.exists' => 'Seleccione una especialidad disponible para 2027.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'correo.email' => 'Ingrese un correo electrónico válido.',
            'in' => 'Seleccione una de las opciones disponibles.',
            'max' => 'El valor ingresado supera el límite permitido.',
        ];
    }
}
