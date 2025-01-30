<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;

class RoomsList extends Component
{
    public function render()
    {
        $rooms = Room::with('season')->get();
        return view('livewire.rooms-list', compact('rooms'));
    }
}