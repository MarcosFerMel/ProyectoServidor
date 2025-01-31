<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">🏨 Gestión de Habitaciones</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        + Nueva Habitación
    </button>

    @if ($isEdit || $name !== null)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-lg font-semibold mb-4">{{ $isEdit ? '✏️ Editar Habitación' : '🛏️ Nueva Habitación' }}</h3>

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

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Capacidad</th>
                    <th class="px-4 py-2 border">Tipo</th>
                    <th class="px-4 py-2 border">Precio</th>
                    <th class="px-4 py-2 border">Temporada</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $room->name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $room->capacity }}</td>
                        <td class="border px-4 py-2">{{ $room->type }}</td>
                        <td class="border px-4 py-2 text-center">${{ $room->price }}</td>
                        <td class="border px-4 py-2">{{ $room->season->name ?? 'Sin temporada' }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $room->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                Editar
                            </button>
                            <button wire:click="delete({{ $room->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2 hover:bg-red-600">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $rooms->links() }}
</div>
