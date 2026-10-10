<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\InteresadoController;
use App\Models\Carrera;
use Illuminate\Support\Facades\Route;

// Ruta pública para ver la oferta académica del año en curso
Route::get('/', function () {
    // Se filtra para que por defecto muestre la oferta del 2027
    $carreras = Carrera::where('anio_academico', 2027)->get();
    return view('welcome', compact('carreras'));
})->name('inicio');

// Ruta pública para registrar un interesado desde el formulario
Route::post('/interesados/guardar', [InteresadoController::class, 'store'])->name('interesados.store');

// Rutas protegidas para el panel de administración
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestión de Carreras
    Route::resource('carreras', CarreraController::class);

    // Gestión de Interesados
    Route::get('/interesados', [InteresadoController::class, 'index'])->name('interesados.index');
    
});

// Rutas de perfil (Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';