<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->words(3, true),
            'nivel_formacion' => 'General',
            'perfil_profesional' => 'Formacion tecnica.',
            'cargos_ocupaciones' => 'Asistente',
            'duracion' => '2 años',
            'ambito_profesional' => 'Industria',
            'requisitos' => 'Sexto grado aprobado',
            'anio_academico' => 2027,
        ];
    }
}
