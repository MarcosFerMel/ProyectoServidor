<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">
        📅 {{ auth()->check() && auth()->user()->role === 'admin' ? 'Gestión de Reservas' : 'Mis Reservas' }}
    </h2>

    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <!-- SOLO ADMINISTRADORES PUEDEN CREAR RESERVAS -->
    @if(auth()->check() && auth()->user()->role === 'admin')
    <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        + Nueva Reserva
    </button>
    @endif

    <!-- Formulario de Creación / Edición -->
    @if ($showForm)
    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-lg font-semibold mb-4">{{ $isEdit ? '✏️ Editar Reserva' : '📅 Nueva Reserva' }}</h3>

            <select wire:model="user_id" class="border p-2 rounded w-full">
                <option value="">Seleccionar usuario</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <select wire:model="room_id" class="border p-2 rounded w-full mt-2">
                <option value="">Seleccionar habitación</option>
                @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>

            <input type="date" wire:model="check_in" class="border p-2 rounded w-full mt-2">
            <input type="date" wire:model="check_out" class="border p-2 rounded w-full mt-2">

            <select wire:model="status" class="border p-2 rounded w-full mt-2">
                <option value="pending">Pendiente</option>
                <option value="confirmed">Confirmada</option>
                <option value="cancelled">Cancelada</option>
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

    <!-- Listado de Reservas -->
    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <th class="border px-4 py-2">Usuario</th>
                    @endif
                    <th class="px-4 py-2 border">Habitación</th>
                    <th class="px-4 py-2 border">Entrada</th>
                    <th class="px-4 py-2 border">Salida</th>
                    <th class="px-4 py-2 border">Estado</th>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <th class="border px-4 py-2">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr class="hover:bg-gray-100">
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <td class="border px-4 py-2">{{ $reservation->user->name }}</td>
                    @endif
                    <td class="border px-4 py-2">{{ $reservation->room->name }}</td>
                    <td class="border px-4 py-2">{{ $reservation->check_in }}</td>
                    <td class="border px-4 py-2">{{ $reservation->check_out }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $reservation->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                            ✏️ Editar
                        </button>
                        <button wire:click="delete({{ $reservation->id }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                            🗑️ Eliminar
                        </button>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $reservations->links() }}
</div>