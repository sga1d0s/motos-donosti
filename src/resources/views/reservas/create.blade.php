@extends('layout')

@section('title','Crear Reserva')

@section('content')
  <h1>➕ Crear Reserva</h1>

  @if($errors->any())
    <div style="color:red"><ul>
      @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul></div>
  @endif

  <form action="{{ route('reservas.store') }}" method="POST">
    @csrf

    <label for="moto_id">Moto:</label>
    <select id="moto_id" name="moto_id" required>
      <option value="">-- Selecciona --</option>
      @foreach($motos as $id=>$modelo)
        <option value="{{ $id }}" {{ old('moto_id')==$id?'selected':'' }}>
          {{ $modelo }}
        </option>
      @endforeach
    </select>

    <label for="fecha_recogida">Fecha de Recogida:</label>
    <input id="fecha_recogida" name="fecha_recogida" type="date"
           value="{{ old('fecha_recogida') }}" required>

    <label for="fecha_entrega">Fecha de Entrega:</label>
    <input id="fecha_entrega" name="fecha_entrega" type="date"
           value="{{ old('fecha_entrega') }}" required>

    <button type="submit" class="primary">Guardar Reserva</button>
  </form>
@endsection