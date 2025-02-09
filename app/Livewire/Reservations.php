<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        return view('livewire.reservations', [
            'reservations' => ($user && $user->role === 'admin')
                ? Reservation::with(['user', 'room'])->paginate(5)  // Admin ve todas las reservas
                : Reservation::where('user_id', $user->id)->with(['room'])->paginate(5),  // Usuario solo ve sus reservas
            'users' => ($user && $user->role === 'admin') ? User::all() : [], // Solo los administradores pueden ver la lista de usuarios
            'rooms' => Room::all(),
        ])->layout('layouts.app');
    }

    public function resetInputs()
    {
        $this->reset(['user_id', 'room_id', 'check_in', 'check_out', 'status', 'reservation_id', 'isEdit', 'showForm']);
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $this->resetInputs();
            $this->isEdit = false;
            $this->showForm = true;
        }
    }

    public function store()
    {
        if (!(Auth::check() && Auth::user()->role === 'admin')) {
            return;
        }

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
        if (!(Auth::check() && Auth::user()->role === 'admin')) {
            return;
        }

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
        if (!(Auth::check() && Auth::user()->role === 'admin')) {
            return;
        }

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
        if (!(Auth::check() && Auth::user()->role === 'admin')) {
            return;
        }

        Reservation::destroy($id);
        session()->flash('message', 'Reserva eliminada.');
    }
}
