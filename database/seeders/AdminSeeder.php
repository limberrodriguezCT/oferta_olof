<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Se verifica si el correo ya existe para no duplicarlo en caso de ejecutar el seeder dos veces
        $user = User::where('email', 'admin@olofpalme.edu.ni')->first();

        if (!$user) {
            User::create([
                'name' => 'Dirección Olof Palme',
                'email' => 'admin@olofpalme.edu.ni',
                'password' => Hash::make('Inatec2027*'),
            ]);
        }
    }
}