<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\InteresadoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\ProfileController;
use App\Models\Carrera;
use App\Models\Interesado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Ruta de inicio (Landing page)
Route::get('/', function () {
    $carreras = Carrera::where('anio_academico', 2027)->get();

    return view('welcome', compact('carreras'));
})->name('inicio');

// NUEVA RUTA: Vista detallada dinámica para cada carrera
Route::get('/especialidad/{id}', function ($id) {
    $carrera = Carrera::findOrFail($id);
    // Pasamos todas las carreras para el formulario de inscripción
    $carreras = Carrera::where('anio_academico', 2027)->get();

    return view('oferta.show', compact('carrera', 'carreras'));
})->name('oferta.show');

Route::get('/matricula', [MatriculaController::class, 'create'])->name('matriculas.create');
Route::post('/matricula', [MatriculaController::class, 'store'])->middleware('throttle:10,1')->name('matriculas.store');

// Ruta para guardar interesados
Route::post('/interesados/guardar', [InteresadoController::class, 'store'])->name('interesados.store');

// Rutas del Panel Administrativo
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $totalCarreras = Carrera::count();
        $totalInteresados = Interesado::count();

        $graficoDatos = Interesado::select('carrera_id', DB::raw('count(*) as total'))
            ->with('carrera')
            ->groupBy('carrera_id')
            ->get();

        $nombresCarreras = $graficoDatos->pluck('carrera.nombre')->toArray();
        $totalesPorCarrera = $graficoDatos->pluck('total')->toArray();

        return view('dashboard', compact('totalCarreras', 'totalInteresados', 'nombresCarreras', 'totalesPorCarrera'));
    })->name('dashboard');

    Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
    Route::get('/matriculas/listado', [MatriculaController::class, 'listado'])->name('matriculas.listado');
    Route::patch('/matriculas/{matricula}/estado', [MatriculaController::class, 'update'])->name('matriculas.update');
    Route::get('/matriculas/{matricula}/imprimir', [MatriculaController::class, 'show'])->name('matriculas.print');

    Route::resource('carreras', CarreraController::class);

    Route::get('/interesados', [InteresadoController::class, 'index'])->name('interesados.index');
    Route::get('/interesados/exportar', [InteresadoController::class, 'export'])->name('interesados.export');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
