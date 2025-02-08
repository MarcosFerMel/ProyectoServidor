<x-guest-layout>
    <div class="relative bg-cover bg-center h-screen" style="background-image: url('/images/casa-rural.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-white text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Altos de la Sierra</h1>
            <p class="text-lg md:text-2xl max-w-2xl">
                Disfruta de la tranquilidad y el confort en nuestra casa rural. Escápate a la naturaleza y vive una experiencia inolvidable.
            </p>
            <div class="mt-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                        Ir al Panel de Gestión
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('rooms') }}" class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                        Ver Habitaciones
                    </a>
                @endauth
            </div>
        </div>
    </div>
</x-guest-layout>
