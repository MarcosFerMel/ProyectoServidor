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
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus reservas.');
    }

    // Si el usuario es administrador, muestra todas las reservas con las relaciones
    if ($user->role === 'admin') {
        $reservations = Reservation::with(['room', 'user'])->get();
    } else {
        // Si el usuario es normal, solo muestra sus reservas
        $reservations = Reservation::where('user_id', $user->id)->with('room')->get();
    }

    return view('reservations.index', compact('reservations'));
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
