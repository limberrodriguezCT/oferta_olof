<?php

namespace App\Http\Requests;

use App\Models\Matricula;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMatriculaEstadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vista' => 'required|boolean',
            'estado' => ['required', Rule::in(array_keys(Matricula::ESTADOS))],
        ];
    }
}
