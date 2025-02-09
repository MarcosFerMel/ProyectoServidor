<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Validation\Rule;

class Reservations extends Component
{
    use WithPagination;

    public $user_id, $room_id, $check_in, $check_out, $status, $reservation_id;
    public $isEdit = false;
    public $showForm = false;

    protected function rules()
    {
        return [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'room_id' => ['required', Rule::exists('rooms', 'id')],
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'status' => 'required|in:pending,confirmed,cancelled',
        ];
    }

    public function render()
    {
        return view('livewire.reservations', [
            'reservations' => Reservation::with(['user', 'room'])->paginate(5),
            'users' => User::all(),
            'rooms' => Room::all(),
        ])->layout('layouts.app');
    }

    public function resetInputs()
    {
        $this->reset(['user_id', 'room_id', 'check_in', 'check_out', 'status', 'reservation_id', 'isEdit', 'showForm']);
    }

    public function create()
    {
        $this->resetInputs();
        $this->isEdit = false;
        $this->showForm = true;
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
        $this->resetInputs();
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
        $this->showForm = true;
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

        session()->flash('message', 'Reserva actualizada con éxito.');
        $this->resetInputs();
    }

    public function delete($id)
    {
        Reservation::destroy($id);
        session()->flash('message', 'Reserva eliminada.');
    }
}
