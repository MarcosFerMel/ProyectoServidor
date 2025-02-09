<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">🏨 Gestión de Habitaciones</h2>

    @if (session()->has('message'))
    <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <!-- Botón para abrir el formulario -->
    <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        + Nueva Habitación
    </button>

    <!-- Formulario de Creación / Edición -->
    @if ($showForm)
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

    <!-- 🏨 Listado de Habitaciones con Galería -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <!-- Imagen Principal -->
            @php
            $images = is_array($room->getImagesAttribute()) ? $room->getImagesAttribute() : [];
            $mainImage = count($images) > 0 ? $images[0] : 'default.jpg';
            @endphp

            <img src="{{ asset('images/rooms/' . $mainImage) }}" alt="Imagen de la habitación" class="w-full h-48 object-cover">

            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800">{{ $room->name }}</h3>
                <p class="text-gray-600">Capacidad: {{ $room->capacity }} personas</p>
                <p class="text-gray-600">Tipo: {{ ucfirst($room->type) }}</p>
                <p class="text-gray-800 font-bold mt-2">💰 ${{ $room->price }}</p>
                <p class="text-sm text-gray-500">{{ $room->season->name ?? 'Sin temporada' }}</p>

                <!-- Galería de imágenes -->
                <div class="mt-2 flex space-x-2">
                    @foreach($images as $index => $img)
                    <img src="{{ asset('images/rooms/' . $img) }}" class="w-16 h-16 object-cover rounded-md border hover:scale-105 transition" alt="Imagen de la habitación">
                    @endforeach
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-between mt-4">
                    <button wire:click="edit({{ $room->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                        ✏️ Editar
                    </button>
                    <button wire:click="delete({{ $room->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        🗑️ Eliminar
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $rooms->links() }}
</div>