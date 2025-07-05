@extends('layout')

@section('title', 'Añadir Moto')

@section('content')
  <h1>Añadir Nueva Moto</h1>

  @if($errors->any())
    <div style="color:red">
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('motos.store') }}" method="POST">
    @csrf

    <label>Modelo:</label>
    <input name="modelo" value="{{ old('modelo') }}" required>

    <label>Matrícula:</label>
    <input name="matricula" value="{{ old('matricula') }}" required>

    <label>Kilómetros:</label>
    <input name="kilometros" type="number" value="{{ old('kilometros') }}" required>

    <label>Fecha ITV:</label>
    <input name="fecha_itv" type="date" value="{{ old('fecha_itv') }}" required>

    <label>Estado:</label>
    <select name="estado" required>
      @foreach(['Libre','Alquilada','Averiada','Otros'] as $e)
        <option value="{{ $e }}" {{ old('estado')==$e?'selected':'' }}>
          {{ $e }}
        </option>
      @endforeach
    </select>

    <label>Comentarios:</label>
    <textarea name="comentarios">{{ old('comentarios') }}</textarea>

    <button type="submit" class="primary">Guardar Moto</button>
  </form>
@endsection