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

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,user',
    ];

    public function render()
    {
        return view('livewire.users', [
            'users' => User::paginate(5),
        ]);
    }

    public function create()
    {
        $this->reset(['name', 'email', 'password', 'role']);
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);
        session()->flash('message', 'Usuario creado con éxito.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|in:admin,user',
        ]);

        User::where('id', $this->user_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);
        session()->flash('message', 'Usuario actualizado.');
    }

    public function delete($id)
    {
        User::destroy($id);
        session()->flash('message', 'Usuario eliminado.');
    }
}
