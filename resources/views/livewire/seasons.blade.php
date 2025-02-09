<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">📅 Gestión de Temporadas</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-2">{{ session('message') }}</div>
    @endif

    <!-- Botón para abrir el formulario -->
    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">
        + Nueva Temporada
    </button>

    <!-- Formulario de Creación / Edición en Modal -->
    @if ($showForm)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $isEdit ? '✏️ Editar Temporada' : '🆕 Nueva Temporada' }}
                </h3>

                <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
                <input type="date" wire:model="start_date" class="border p-2 rounded w-full mt-2">
                <input type="date" wire:model="end_date" class="border p-2 rounded w-full mt-2">
                <input type="number" wire:model="price_multiplier" step="0.1" class="border p-2 rounded w-full mt-2">

                <div class="flex justify-between mt-4">
                    @if ($isEdit)
                        <button wire:click="update" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">
                            💾 Guardar Cambios
                        </button>
                    @else
                        <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">
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

    <!-- Tabla de Temporadas -->
    <table class="table-auto w-full mt-4 border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Inicio</th>
                <th class="border px-4 py-2">Fin</th>
                <th class="border px-4 py-2">Multiplicador de Precio</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seasons as $season)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $season->name }}</td>
                    <td class="border px-4 py-2">{{ $season->start_date }}</td>
                    <td class="border px-4 py-2">{{ $season->end_date }}</td>
                    <td class="border px-4 py-2">{{ $season->price_multiplier }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $season->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded shadow hover:bg-yellow-600">
                            ✏️ Editar
                        </button>
                        <button wire:click="delete({{ $season->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2 shadow hover:bg-red-600">
                            🗑️ Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $seasons->links() }}
</div>
