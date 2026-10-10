<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Http\Requests\StoreCarreraRequest;
use App\Http\Requests\UpdateCarreraRequest;
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

    public function store(StoreCarreraRequest $request)
    {
        $datos = $request->validated();

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

    public function update(UpdateCarreraRequest $request, Carrera $carrera)
    {
        $datos = $request->validated();

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