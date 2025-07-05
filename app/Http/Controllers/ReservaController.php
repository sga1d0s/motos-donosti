<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\Moto;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargamos moto y ordenamos por fecha_recogida
        $reservas = Reserva::with('moto')
            ->orderBy('fecha_recogida', 'desc')
            ->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Listado de motos “libres” o “reservables”
        $motos = Moto::all()->pluck('modelo', 'id');
        return view('reservas.create', compact('motos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'moto_id'        => 'required|exists:motos,id',
            'fecha_recogida' => 'required|date|before_or_equal:fecha_entrega',
            'fecha_entrega'  => 'required|date|after_or_equal:fecha_recogida',
        ]);

        Reserva::create($data);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        // Lista de motos para el <select>
        $motos = Moto::pluck('modelo', 'id');
        return view('reservas.edit', compact('reserva', 'motos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        $data = $request->validate([
            'moto_id'        => 'required|exists:motos,id',
            'fecha_recogida' => 'required|date|before_or_equal:fecha_entrega',
            'fecha_entrega'  => 'required|date|after_or_equal:fecha_recogida',
        ]);

        $reserva->update($data);

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')
            ->with('success', 'Reserva eliminada.');
    }
}
