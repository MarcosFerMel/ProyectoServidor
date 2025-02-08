<x-guest-layout>
    <!-- Barra de Navegación -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">Altos de la Sierra</a>

            <!-- Links de navegación -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Inicio</a>
                <a href="{{ route('rooms') }}" class="text-gray-900 font-semibold">Habitaciones</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Iniciar Sesión</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Nuestras Habitaciones</h1>
        <p class="text-lg text-center text-gray-600 mb-12">Descubre el confort y la elegancia de nuestras habitaciones diseñadas para tu descanso.</p>

        <!-- Grid de Habitaciones -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($rooms as $room)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('images/rooms/' . $room->image) }}" alt="{{ $room->name }}" class="w-full h-56 object-cover">
                    
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $room->name }}</h2>
                        <p class="text-gray-500 text-sm">Capacidad: {{ $room->capacity }} personas</p>
                        <p class="text-gray-500 text-sm">Tipo: {{ ucfirst($room->type) }}</p>
                        <p class="text-lg font-semibold text-blue-600 mt-2">${{ number_format($room->price, 2) }} / noche</p>

                        <div class="mt-4">
                            <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Reservar Ahora</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
