<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Season;

class Seasons extends Component
{
    use WithPagination;

    public $name, $start_date, $end_date, $price_multiplier, $season_id;
    public $isEdit = false;
    public $showForm = false; // Nueva variable para manejar el formulario

    protected $rules = [
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'price_multiplier' => 'required|numeric|min:0.1',
    ];

    public function render()
    {
        return view('livewire.seasons', [
            'seasons' => Season::paginate(5),
        ])->layout('layouts.app');
    }

    public function resetInputs()
    {
        $this->reset(['name', 'start_date', 'end_date', 'price_multiplier', 'season_id', 'isEdit', 'showForm']);
    }

    public function create()
    {
        $this->resetInputs();
        $this->showForm = true; // Mostrar formulario
    }

    public function store()
    {
        $this->validate();
        Season::create([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'price_multiplier' => $this->price_multiplier,
        ]);
        session()->flash('message', 'Temporada creada con éxito.');
        $this->resetInputs();
    }

    public function edit($id)
    {
        $season = Season::findOrFail($id);
        $this->season_id = $season->id;
        $this->name = $season->name;
        $this->start_date = $season->start_date;
        $this->end_date = $season->end_date;
        $this->price_multiplier = $season->price_multiplier;
        $this->isEdit = true;
        $this->showForm = true; // Mostrar formulario en modo edición
    }

    public function update()
    {
        if (!$this->season_id) {
            session()->flash('error', 'No se puede actualizar sin seleccionar una temporada.');
            return;
        }

        $this->validate();
        Season::where('id', $this->season_id)->update([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'price_multiplier' => $this->price_multiplier,
        ]);
        session()->flash('message', 'Temporada actualizada.');
        $this->resetInputs(); // Ocultar formulario tras actualizar
    }

    public function delete($id)
    {
        Season::destroy($id);
        session()->flash('message', 'Temporada eliminada.');
    }
}
