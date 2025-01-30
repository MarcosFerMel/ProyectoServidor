<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;

class Reservations extends Component
{
    use WithPagination;

    public $user_id, $room_id, $check_in, $check_out, $status, $reservation_id;
    public $isEdit = false;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'room_id' => 'required|exists:rooms,id',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'status' => 'required|in:pending,confirmed,cancelled',
    ];

    public function render()
    {
        return view('livewire.reservations', [
            'reservations' => Reservation::with(['user', 'room'])->paginate(5),
            'users' => User::all(),
            'rooms' => Room::all(),
        ]);
    }

    public function create()
    {
        $this->reset(['user_id', 'room_id', 'check_in', 'check_out', 'status']);
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();
        Reservation::create([
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'status' => $this->status,
        ]);
        session()->flash('message', 'Reserva creada con éxito.');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $this->reservation_id = $reservation->id;
        $this->user_id = $reservation->user_id;
        $this->room_id = $reservation->room_id;
        $this->check_in = $reservation->check_in;
        $this->check_out = $reservation->check_out;
        $this->status = $reservation->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        Reservation::where('id', $this->reservation_id)->update([
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'status' => $this->status,
        ]);
        session()->flash('message', 'Reserva actualizada.');
    }

    public function delete($id)
    {
        Reservation::destroy($id);
        session()->flash('message', 'Reserva eliminada.');
    }
}
