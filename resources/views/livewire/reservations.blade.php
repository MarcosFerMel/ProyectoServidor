<div>
    <h2 class="text-xl font-bold mb-4">Gestión de Reservas</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-2">{{ session('message') }}</div>
    @endif

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Reserva</button>

    @if ($isEdit)
        <div class="mt-4">
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

            <button wire:click="update" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Actualizar</button>
        </div>
    @else
        <div class="mt-4">
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

            <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Guardar</button>
        </div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">Usuario</th>
                <th class="border px-4 py-2">Habitación</th>
                <th class="border px-4 py-2">Entrada</th>
                <th class="border px-4 py-2">Salida</th>
                <th class="border px-4 py-2">Estado</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td class="border px-4 py-2">{{ $reservation->user->name }}</td>
                    <td class="border px-4 py-2">{{ $reservation->room->name }}</td>
                    <td class="border px-4 py-2">{{ $reservation->check_in }}</td>
                    <td class="border px-4 py-2">{{ $reservation->check_out }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $reservation->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $reservation->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reservations->links() }}
</div>
