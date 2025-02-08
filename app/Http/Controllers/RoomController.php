<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
{
    // Verificamos si la solicitud viene de una API o desde el navegador
    if (request()->expectsJson()) {
        return response()->json(Room::all());
    }

    // Para usuarios normales, cargamos la vista con las habitaciones
    $rooms = Room::with('season')->get();
    return view('rooms.index', compact('rooms'));
}



    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'type' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Habitación creada correctamente.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'type' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Habitación actualizada correctamente.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Habitación eliminada correctamente.');
    }
}
