<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Season;

class SeasonsList extends Component
{
    public function render()
    {
        $seasons = Season::all();
        return view('livewire.seasons-list', compact('seasons'));
    }
}
