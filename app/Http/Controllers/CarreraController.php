<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        // 1. Reglas de validación que activan los mensajes de error en la vista
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'nivel_formacion' => 'required|string',
            'perfil_profesional' => 'required|string',
            'cargos_ocupaciones' => 'required|string',
            'duracion' => 'required|string',
            'anio_academico' => 'required|integer',
            'ambito_profesional' => 'required|string',
            'requisitos' => 'required|string',
            'imagen_ruta' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url' => 'nullable|url'
        ]);

        // 2. Procesamiento de la imagen si el usuario subió una
        if ($request->hasFile('imagen_ruta')) {
            $validated['imagen_ruta'] = $request->file('imagen_ruta')->store('carreras', 'public');
        }

        // 3. Creación del registro en la base de datos
        Carrera::create($validated);

        // 4. Redirección con el mensaje de éxito para SweetAlert
        return redirect()->route('carreras.index')->with('success', 'Especialidad registrada correctamente.');
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'nivel_formacion' => 'required|string',
            'perfil_profesional' => 'required|string',
            'cargos_ocupaciones' => 'required|string',
            'duracion' => 'required|string',
            'anio_academico' => 'required|integer',
            'ambito_profesional' => 'required|string',
            'requisitos' => 'required|string',
            'imagen_ruta' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url' => 'nullable|url'
        ]);

        if ($request->hasFile('imagen_ruta')) {
            // Eliminar la imagen anterior del servidor para no acumular basura
            if ($carrera->imagen_ruta) {
                Storage::disk('public')->delete($carrera->imagen_ruta);
            }
            $validated['imagen_ruta'] = $request->file('imagen_ruta')->store('carreras', 'public');
        }

        $carrera->update($validated);

        return redirect()->route('carreras.index')->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(Carrera $carrera)
    {
        // Eliminar la imagen del servidor al borrar la carrera
        if ($carrera->imagen_ruta) {
            Storage::disk('public')->delete($carrera->imagen_ruta);
        }
        $carrera->delete();

        return redirect()->route('carreras.index')->with('success', 'Especialidad eliminada permanentemente.');
    }
}