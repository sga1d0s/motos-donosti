@extends('layout')

@section('title', 'Listado de Motos')

@section('content')
    <h1 class="mb-4">Listado de Motos</h1>
    <p><a href="{{ route('motos.create') }}">➕ Añadir Moto Nueva</a></p>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Edit</th>
                <th class="px-4 py-2 text-left">Moto</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-left">Fecha de Entrega</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($motos as $moto)
                <tr class="border-t">
                    {{-- 0) Editar moto --}}
                    <td data-label="Acciones">
                        <a href="{{ route('motos.edit', $moto) }}">✏️</a>
                    </td>

                    {{-- 1) Nombre de la moto --}}
                    <td class="px-4 py-2">{{ $moto->modelo }}</td>

                    {{-- 2) Estado computado --}}
                    <td class="px-4 py-2">{{ $moto->computed_status }}</td>

                    {{-- 3) Fecha de entrega (si existe alguna reserva) --}}
                    <td class="px-4 py-2">
                        @php
                            // Buscamos la siguiente reserva asociada (o la actual)
                            $reserva = $moto->reservas
                                ->where('fecha_entrega', '>=', now()->toDateString())
                                ->sortBy('fecha_entrega')
                                ->first();
                        @endphp

                        @if ($reserva)
                            {{ \Carbon\Carbon::parse($reserva->fecha_entrega)->format('Y-m-d') }}
                        @else
                            &mdash;
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
