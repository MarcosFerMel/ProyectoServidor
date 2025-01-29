<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    public function index()
    {
        return response()->json(Season::all(), 200);
    }

    public function create()
    {
        return view('seasons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price_multiplier' => 'required|numeric',
        ]);

        Season::create($request->all());

        return redirect()->route('seasons.index')->with('success', 'Temporada creada correctamente.');
    }

    public function destroy(Season $season)
    {
        $season->delete();
        return redirect()->route('seasons.index')->with('success', 'Temporada eliminada correctamente.');
    }
}
