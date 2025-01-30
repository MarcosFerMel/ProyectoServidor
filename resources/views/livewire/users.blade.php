<div>
    <h2 class="text-xl font-bold mb-4">Gestión de Usuarios</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-2">{{ session('message') }}</div>
    @endif

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Nuevo Usuario</button>

    @if ($isEdit)
        <div class="mt-4">
            <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
            <input type="email" wire:model="email" placeholder="Correo" class="border p-2 rounded w-full mt-2">
            <select wire:model="role" class="border p-2 rounded w-full mt-2">
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <button wire:click="update" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Actualizar</button>
        </div>
    @else
        <div class="mt-4">
            <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
            <input type="email" wire:model="email" placeholder="Correo" class="border p-2 rounded w-full mt-2">
            <input type="password" wire:model="password" placeholder="Contraseña" class="border p-2 rounded w-full mt-2">
            <select wire:model="role" class="border p-2 rounded w-full mt-2">
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Guardar</button>
        </div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Correo</th>
                <th class="border px-4 py-2">Rol</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
        
