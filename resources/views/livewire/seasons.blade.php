<div>
    <h2 class="text-xl font-bold mb-4">Gestión de Temporadas</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-2">{{ session('message') }}</div>
    @endif

    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Temporada</button>

    @if ($isEdit)
        <div class="mt-4">
            <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
            <input type="date" wire:model="start_date" class="border p-2 rounded w-full mt-2">
            <input type="date" wire:model="end_date" class="border p-2 rounded w-full mt-2">
            <input type="number" wire:model="price_multiplier" step="0.1" class="border p-2 rounded w-full mt-2">
            <button wire:click="update" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Actualizar</button>
        </div>
    @else
        <div class="mt-4">
            <input type="text" wire:model="name" placeholder="Nombre" class="border p-2 rounded w-full">
            <input type="date" wire:model="start_date" class="border p-2 rounded w-full mt-2">
            <input type="date" wire:model="end_date" class="border p-2 rounded w-full mt-2">
            <input type="number" wire:model="price_multiplier" step="0.1" class="border p-2 rounded w-full mt-2">
            <button wire:click="store" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Guardar</button>
        </div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Inicio</th>
                <th class="border px-4 py-2">Fin</th>
                <th class="border px-4 py-2">Multiplicador de Precio</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td class="border px-4 py-2">{{ $season->name }}</td>
                    <td class="border px-4 py-2">{{ $season->start_date }}</td>
                    <td class="border px-4 py-2">{{ $season->end_date }}</td>
                    <td class="border px-4 py-2">{{ $season->price_multiplier }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $season->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $season->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $seasons->links() }}
</div>
