<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarreraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'nivel_formacion' => 'required|string|max:255',
            'perfil_profesional' => 'required|string',
            'cargos_ocupaciones' => 'required|string',
            'duracion' => 'required|string',
            'ambito_profesional' => 'required|string',
            'requisitos' => 'required|string',
            'imagen_ruta' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url' => 'nullable|url',
            'anio_academico' => 'required|digits:4|integer',
        ];
    }
}