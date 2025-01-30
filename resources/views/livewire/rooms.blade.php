<div>
    <h2 class="text-xl font-bold mb-4">Gestión de Habitaciones</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-2">{{ session('message') }}</div>
    @endif

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Habitación</button>

    @if ($isEdit)
        <div class="mt-4">
            <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
            <input type="number" wire:model="capacity" placeholder="Capacidad" class="border p-2 rounded w-full mt-2">
            <input type="text" wire:model="type" placeholder="Tipo" class="border p-2 rounded w-full mt-2">
            <input type="number" wire:model="price" placeholder="Precio" class="border p-2 rounded w-full mt-2">
            <select wire:model="season_id" class="border p-2 rounded w-full mt-2">
                <option value="">Seleccionar temporada</option>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->name }}</option>
                @endforeach
            </select>

            <button wire:click="update" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Actualizar</button>
        </div>
    @else
        <div class="mt-4">
            <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
            <input type="number" wire:model="capacity" placeholder="Capacidad" class="border p-2 rounded w-full mt-2">
            <input type="text" wire:model="type" placeholder="Tipo" class="border p-2 rounded w-full mt-2">
            <input type="number" wire:model="price" placeholder="Precio" class="border p-2 rounded w-full mt-2">
            <select wire:model="season_id" class="border p-2 rounded w-full mt-2">
                <option value="">Seleccionar temporada</option>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->name }}</option>
                @endforeach
            </select>

            <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Guardar</button>
        </div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Capacidad</th>
                <th class="border px-4 py-2">Tipo</th>
                <th class="border px-4 py-2">Precio</th>
                <th class="border px-4 py-2">Temporada</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td class="border px-4 py-2">{{ $room->name }}</td>
                    <td class="border px-4 py-2">{{ $room->capacity }}</td>
                    <td class="border px-4 py-2">{{ $room->type }}</td>
                    <td class="border px-4 py-2">${{ $room->price }}</td>
                    <td class="border px-4 py-2">{{ $room->season->name ?? 'Sin temporada' }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $room->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $room->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $rooms->links() }}
</div>
