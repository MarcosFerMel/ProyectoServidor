<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Season;

class Rooms extends Component
{
    use WithPagination;

    public $name, $capacity, $type, $price, $season_id, $room_id;
    public $isEdit = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
        'type' => 'required|string',
        'price' => 'required|numeric',
        'season_id' => 'required|exists:seasons,id',
    ];

    public function render()
    {
        return view('livewire.rooms', [
            'rooms' => Room::with('season')->paginate(5),
            'seasons' => Season::all(),
        ]);
    }

    public function create()
    {
        $this->reset(['name', 'capacity', 'type', 'price', 'season_id']);
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();
        Room::create([
            'name' => $this->name,
            'capacity' => $this->capacity,
            'type' => $this->type,
            'price' => $this->price,
            'season_id' => $this->season_id,
        ]);
        session()->flash('message', 'Habitación creada con éxito.');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $this->room_id = $room->id;
        $this->name = $room->name;
        $this->capacity = $room->capacity;
        $this->type = $room->type;
        $this->price = $room->price;
        $this->season_id = $room->season_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        Room::where('id', $this->room_id)->update([
            'name' => $this->name,
            'capacity' => $this->capacity,
            'type' => $this->type,
            'price' => $this->price,
            'season_id' => $this->season_id,
        ]);
        session()->flash('message', 'Habitación actualizada.');
    }

    public function delete($id)
    {
        Room::destroy($id);
        session()->flash('message', 'Habitación eliminada.');
    }
}
