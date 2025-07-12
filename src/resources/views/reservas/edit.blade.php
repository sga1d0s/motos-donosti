@extends('layout')

@section('title', 'Editar Reserva')

@section('content')
    <h1>✏️ Editar Reserva #{{ $reserva->id }}</h1>

    @if ($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservas.update', $reserva) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="moto_id">Moto:</label>
        <select id="moto_id" name="moto_id" required>
            @foreach ($motos as $id => $modelo)
                <option value="{{ $id }}" {{ $reserva->moto_id == $id ? 'selected' : '' }}>
                    {{ $modelo }}
                </option>
            @endforeach
        </select>

        <label for="fecha_recogida">Fecha de Recogida:</label>
        <input id="fecha_recogida" name="fecha_recogida" type="date"
            value="{{ old('fecha_recogida', $reserva->fecha_recogida) }}" required>

        <label for="fecha_entrega">Fecha de Entrega:</label>
        <input id="fecha_entrega" name="fecha_entrega" type="date"
            value="{{ old('fecha_entrega', $reserva->fecha_entrega) }}" required>

        <button type="submit" class="primary">Actualizar Reserva</button>
    </form>
    <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" onsubmit="return confirm('¿Eliminar reserva?')">
        @csrf
        @method('DELETE')
        <button class="delete" type="submit">🗑️</button>
    </form>
@endsection
