@extends('layouts.app')

@section('content')
    <h2>Habitaciones</h2>
    <ul>
        @foreach ($rooms as $room)
            <li>{{ $room->name }} - Capacidad: {{ $room->capacity }} - Precio: ${{ $room->price }}</li>
        @endforeach
    </ul>
@endsection
