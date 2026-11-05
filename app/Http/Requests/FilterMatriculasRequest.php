<?php

namespace App\Http\Requests;

use App\Models\Matricula;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterMatriculasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'carrera_id' => 'nullable|integer|exists:carreras,id',
            'nombre' => 'required_without:carrera_id|nullable|string|max:255',
            'anio' => 'required_without:carrera_id|nullable|integer|min:1900|max:9999',
            'q' => 'nullable|string|max:120',
            'desde' => 'nullable|date_format:Y-m-d',
            'hasta' => ['nullable', 'date_format:Y-m-d', Rule::when($this->filled('desde'), 'after_or_equal:desde')],
            'estado' => ['nullable', Rule::in(array_keys(Matricula::ESTADOS))],
            'vista' => 'nullable|boolean',
            'orden' => ['nullable', Rule::in(['recientes', 'antiguas', 'nombre'])],
        ];
    }

    public function messages(): array
    {
        return ['hasta.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicial.'];
    }
}
