@extends('layout')

@section('title', 'Editar Moto')

@section('content')
  <h1>Editar Moto #{{ $moto->id }}</h1>

  @if($errors->any())
    <div style="color:red">
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('motos.update', $moto) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Modelo:</label>
    <input name="modelo" value="{{ old('modelo', $moto->modelo) }}" required>

    <label>Matrícula:</label>
    <input name="matricula" value="{{ old('matricula', $moto->matricula) }}" required>

    <label>Kilómetros:</label>
    <input name="kilometros" type="number" value="{{ old('kilometros', $moto->kilometros) }}" required>

    <label>Fecha ITV:</label>
    <input name="fecha_itv" type="date" value="{{ old('fecha_itv', $moto->fecha_itv->format('Y-m-d')) }}" required>

    <label>Estado:</label>
    <select name="estado" required>
      @foreach(['Libre','Alquilada','Averiada','Otros'] as $e)
        <option value="{{ $e }}" {{ old('estado', $moto->estado)==$e ? 'selected' : '' }}>
          {{ $e }}
        </option>
      @endforeach
    </select>

    <label>Comentarios:</label>
    <textarea name="comentarios">{{ old('comentarios', $moto->comentarios) }}</textarea>

    <button type="submit" class="primary">Actualizar Moto</button>
  </form>

  <form action="{{ route('motos.destroy', $moto) }}" method="POST" onsubmit="return confirm('¿Eliminar esta moto?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete">Eliminar Moto</button>
  </form>
@endsection