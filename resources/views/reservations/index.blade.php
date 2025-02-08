<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Listado de Reservas</h2>

                @if($reservations->isEmpty())
                    <p class="text-gray-500">No tienes reservas registradas.</p>
                @else
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border p-2">Habitación</th>
                                <th class="border p-2">Fecha de Entrada</th>
                                <th class="border p-2">Fecha de Salida</th>
                                <th class="border p-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="border p-2">{{ $reservation->room->name }}</td>
                                    <td class="border p-2">{{ $reservation->check_in }}</td>
                                    <td class="border p-2">{{ $reservation->check_out }}</td>
                                    <td class="border p-2">{{ ucfirst($reservation->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
