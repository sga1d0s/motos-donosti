<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::all();
        return view('home', compact('motos'));
    }

    public function create()
    {
        return view('motos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo'     => 'required|string',
            'matricula'  => 'required|string',
            'kilometros' => 'required|integer',
            'fecha_itv'  => 'required|date',
            'estado'     => 'required|in:Libre,Alquilada,Averiada,Otros',
            'comentarios' => 'nullable|string',
        ]);

        Moto::create($request->all());

        return redirect()->route('motos.index');
    }

    /**
     * Elimina una moto y redirige al listado.
     */
    public function destroy(Moto $moto)
    {
        $moto->delete();
        return redirect()->route('motos.index');
    }
}
