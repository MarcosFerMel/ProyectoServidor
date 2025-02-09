<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">👥 Gestión de Usuarios</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <!-- Botón para abrir el formulario -->
    <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        + Nuevo Usuario
    </button>

    <!-- Formulario de Creación / Edición -->
    @if ($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-lg font-semibold mb-4">{{ $isEdit ? '✏️ Editar Usuario' : '👤 Nuevo Usuario' }}</h3>

                <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
                <input type="email" wire:model="email" placeholder="Correo" class="border p-2 rounded w-full mt-2">
                
                @if (!$isEdit)
                    <input type="password" wire:model="password" placeholder="Contraseña" class="border p-2 rounded w-full mt-2">
                @endif
                
                <select wire:model="role" class="border p-2 rounded w-full mt-2">
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>

                <div class="flex justify-between mt-4">
                    @if ($isEdit)
                        <button wire:click="update" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
                            💾 Guardar Cambios
                        </button>
                    @else
                        <button wire:click="store" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                            ✅ Crear
                        </button>
                    @endif
                    <button wire:click="resetInputs" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">
                        ❌ Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Listado de Usuarios -->
    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Correo</th>
                    <th class="px-4 py-2 border">Rol</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $user->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                ✏️ Editar
                            </button>
                            <button wire:click="delete({{ $user->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2 hover:bg-red-600">
                                🗑️ Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>
