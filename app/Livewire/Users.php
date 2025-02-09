<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    public $name, $email, $password, $role, $user_id;
    public $isEdit = false;
    public $showForm = false; // Control de visibilidad del formulario

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'nullable|min:6',  // El password solo es obligatorio al crear un usuario
        'role' => 'required|in:admin,user',
    ];

    public function render()
    {
        return view('livewire.users', [
            'users' => User::paginate(5),
        ])->layout('layouts.app');
    }

    public function resetInputs()
    {
        $this->reset(['name', 'email', 'password', 'role', 'user_id', 'isEdit', 'showForm']);
    }

    public function create()
    {
        $this->resetInputs();
        $this->isEdit = false;
        $this->showForm = true; // Ahora se muestra el formulario
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // La contraseña es obligatoria al crear
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        session()->flash('message', 'Usuario creado con éxito.');
        $this->resetInputs();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->isEdit = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($this->user_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        session()->flash('message', 'Usuario actualizado.');
        $this->resetInputs();
    }

    public function delete($id)
    {
        User::destroy($id);
        session()->flash('message', 'Usuario eliminado.');
    }
}
