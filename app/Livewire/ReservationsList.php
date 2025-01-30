<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class ReservationsList extends Component
{
    public function render()
    {
        $reservations = Reservation::with(['user', 'room'])->get();
        return view('livewire.reservations-list', compact('reservations'));
    }
}