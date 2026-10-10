<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInteresadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'carrera_id' => 'required|exists:carreras,id',
            'nombre_completo' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:255',
        ];
    }
}