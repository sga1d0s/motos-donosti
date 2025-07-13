@extends('layout')

@section('title', 'Listado de Reservas')

@section('content')
    <h1 class="mb-4">ReservasS</h1>
    <p><a href="{{ route('reservas.create') }}">➕ Nueva Reserva</a></p>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th></th>
                <th>Moto</th>
                <th>Desde</th>
                <th>Hasta</th>
            </tr>
        </thead>
        <tbody>
    @forelse($reservas as $res)
        <tr>
            <td>
                <a href="{{ route('reservas.edit', $res) }}">✏️</a>
            </td>
            {{-- Protegemos el acceso a modelo --}}
            <td>{{ $res->moto?->modelo ?? '— sin moto —' }}</td>
            <td>{{ $res->fecha_recogida->format('d-m') }}</td>
            <td>{{ $res->fecha_entrega->format('d-m') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No hay reservas</td>
        </tr>
    @endforelse
</tbody>
    </table>
@endsection
