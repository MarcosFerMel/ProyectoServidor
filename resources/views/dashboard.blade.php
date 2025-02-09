<x-app-layout>
    <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">

        @if(auth()->user()->isAdmin())
            <!-- Título -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel de Administración</h1>
            <p class="text-gray-600 mb-8">Administra habitaciones, reservas, temporadas y usuarios.</p>

            <!-- Sección de Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow-md rounded-lg p-6 text-center border-t-4 border-blue-500">
                    <h2 class="text-xl font-semibold text-gray-700">Habitaciones</h2>
                    <p class="text-4xl font-bold text-blue-600">{{ \App\Models\Room::count() }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center border-t-4 border-green-500">
                    <h2 class="text-xl font-semibold text-gray-700">Reservas</h2>
                    <p class="text-4xl font-bold text-green-600">{{ \App\Models\Reservation::count() }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center border-t-4 border-orange-500">
                    <h2 class="text-xl font-semibold text-gray-700">Usuarios</h2>
                    <p class="text-4xl font-bold text-orange-600">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center border-t-4 border-purple-500">
                    <h2 class="text-xl font-semibold text-gray-700">Temporadas</h2>
                    <p class="text-4xl font-bold text-purple-600">{{ \App\Models\Season::count() }}</p>
                </div>
            </div>

            <!-- Últimas Reservas -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Últimas Reservas</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border p-2">Usuario</th>
                                <th class="border p-2">Habitación</th>
                                <th class="border p-2">Entrada</th>
                                <th class="border p-2">Salida</th>
                                <th class="border p-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\Reservation::latest()->take(5)->get() as $reservation)
                                <tr class="hover:bg-gray-100">
                                    <td class="border p-2">{{ $reservation->user->name ?? 'N/A' }}</td>
                                    <td class="border p-2">{{ $reservation->room->name ?? 'N/A' }}</td>
                                    <td class="border p-2">{{ $reservation->check_in }}</td>
                                    <td class="border p-2">{{ $reservation->check_out }}</td>
                                    <td class="border p-2">
                                        <span class="px-2 py-1 rounded-full text-white 
                                            {{ $reservation->status == 'confirmada' ? 'bg-green-500' : 'bg-red-500' }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Mensaje de bienvenida para usuarios -->
            <h1 class="text-3xl font-bold text-gray-800 mb-6">¡Bienvenido, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600">Nos alegra tenerte aquí. Echa un vistazo a las habitaciones disponibles y al estado de tus reservas.</p>
        @endif
    </div>
</x-app-layout>
