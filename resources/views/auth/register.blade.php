<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center relative"
        style="background-image: url('/images/background.jpg');">
        
        <!-- Botón para Volver a Inicio -->
        <a href="{{ route('home') }}" 
            class="absolute top-6 left-6 px-5 py-2 border-2 border-white text-white font-semibold rounded-full 
                   hover:bg-white hover:text-gray-800 transition duration-300 shadow-lg">
            ⬅ Volver a Inicio
        </a>

        <div class="bg-white/80 shadow-lg rounded-lg p-8 w-full max-w-md backdrop-blur-md">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Altos de la Sierra" class="h-16">
                </a>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Crear una Cuenta</h2>
            <p class="text-sm text-center text-gray-600 mb-6">Regístrate para poder realizar reservas y gestionar tu cuenta.</p>

            <!-- Formulario de Registro -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nombre Completo</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Botón de Registro -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Registrarse
                </button>

            </form>
        </div>
    </div>
</x-guest-layout>
