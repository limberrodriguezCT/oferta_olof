<?php

namespace App\Http\Controllers;

use App\Models\Interesado;
use App\Http\Requests\StoreInteresadoRequest;

class InteresadoController extends Controller
{
    public function index()
    {
        $interesados = Interesado::with('carrera')->orderBy('created_at', 'desc')->get();
        return view('interesados.index', compact('interesados'));
    }

    public function store(StoreInteresadoRequest $request)
    {
        Interesado::create($request->validated());

        return redirect()->back()->with('success', 'Sus datos han sido registrados. Pronto nos comunicaremos.');
    }
}