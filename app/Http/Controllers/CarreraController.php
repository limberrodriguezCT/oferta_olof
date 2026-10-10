<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::orderBy('anio_academico', 'desc')->get();
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
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
        ]);

        $datos = $request->all();

        if ($request->hasFile('imagen_ruta')) {
            $datos['imagen_ruta'] = $request->file('imagen_ruta')->store('carreras', 'public');
        }

        Carrera::create($datos);

        return redirect()->route('carreras.index')->with('success', 'Carrera registrada correctamente.');
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
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
        ]);

        $datos = $request->all();

        if ($request->hasFile('imagen_ruta')) {
            if ($carrera->imagen_ruta) {
                Storage::disk('public')->delete($carrera->imagen_ruta);
            }
            $datos['imagen_ruta'] = $request->file('imagen_ruta')->store('carreras', 'public');
        }

        $carrera->update($datos);

        return redirect()->route('carreras.index')->with('success', 'Carrera actualizada correctamente.');
    }

    public function destroy(Carrera $carrera)
    {
        if ($carrera->imagen_ruta) {
            Storage::disk('public')->delete($carrera->imagen_ruta);
        }
        $carrera->delete();

        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada correctamente.');
    }
}