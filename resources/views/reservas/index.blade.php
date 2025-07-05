@extends('layout')

@section('title', 'Listado de Reservas')

@section('content')
    <h1 class="mb-4">Reservas</h1>
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
                    {{-- 0) Editar reserva --}}
                    <td>
                        <a href="{{ route('reservas.edit', $res) }}">✏️</a>
                    </td>
                    <td>{{ $res->moto->modelo }}</td>
                    <td>{{ $res->fecha_recogida->format('d-m') }}</td>
                    <td>{{ $res->fecha_entrega->format('d-m') }}</td>
                    <td>
                        <form action="{{ route('reservas.destroy', $res) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar reserva?')">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay reservas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
