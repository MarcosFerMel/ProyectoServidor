<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Habitaciones Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Listado de Habitaciones</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($rooms as $room)
                        <div class="border p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold">{{ $room->name }}</h3>
                            <p><strong>Capacidad:</strong> {{ $room->capacity }} personas</p>
                            <p><strong>Tipo:</strong> {{ ucfirst($room->type) }}</p>
                            <p><strong>Precio:</strong> ${{ $room->price }} por noche</p>
                            <p><strong>Temporada:</strong> {{ $room->season->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
