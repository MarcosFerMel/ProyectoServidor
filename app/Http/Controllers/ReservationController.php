<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
{
    try {
        $reservations = Reservation::with(['user', 'room'])->get();

        if ($reservations->isEmpty()) {
            return response()->json(['message' => 'No hay reservas registradas'], 200);
        }

        return response()->json($reservations, 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Ocurrió un error',
            'message' => $e->getMessage(),
        ], 500);
    }
}

    
    


    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
