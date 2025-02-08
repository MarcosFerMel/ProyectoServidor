@extends('layouts.app')

@section('content')
    <h2>Tus Reservas</h2>
    <ul>
        @foreach ($reservations as $reservation)
            <li>{{ $reservation->room->name }} - Entrada: {{ $reservation->check_in }} - Salida: {{ $reservation->check_out }}</li>
        @endforeach
    </ul>
@endsection
