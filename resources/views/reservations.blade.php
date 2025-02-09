<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 {{ auth()->check() && auth()->user()->role === 'admin' ? 'Gestión de Reservas' : 'Mis Reservas' }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- SOLO ADMINISTRADORES PUEDEN CREAR RESERVAS -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                + Nueva Reserva
            </button>
        @endif

        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    @if(auth()->check() && auth()->user()->role === 'admin') 
                        <th class="border px-4 py-2">Usuario</th> 
                    @endif
                    <th class="border px-4 py-2">Habitación</th>
                    <th class="border px-4 py-2">Entrada</th>
                    <th class="border px-4 py-2">Salida</th>
                    <th class="border px-4 py-2">Estado</th>
                    @if(auth()->check() && auth()->user()->role === 'admin') 
                        <th class="border px-4 py-2">Acciones</th> 
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        @if(auth()->check() && auth()->user()->role === 'admin') 
                            <td class="border px-4 py-2">{{ $reservation->user->name }}</td> 
                        @endif
                        <td class="border px-4 py-2">{{ $reservation->room->name }}</td>
                        <td class="border px-4 py-2">{{ $reservation->check_in }}</td>
                        <td class="border px-4 py-2">{{ $reservation->check_out }}</td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 rounded-full text-white 
                                {{ $reservation->status == 'confirmed' ? 'bg-green-500' : ($reservation->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
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
</x-app-layout>
