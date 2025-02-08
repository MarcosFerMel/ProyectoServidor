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

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Iniciar Sesión</h2>
            <p class="text-sm text-center text-gray-600 mb-6">Ingresa tus credenciales para acceder.</p>

            <!-- Formulario de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required autofocus
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- Recordarme y Olvidé mi contraseña -->
                <div class="flex justify-between items-center mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox text-blue-500">
                        <span class="ml-2 text-gray-700 text-sm">Recuérdame</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-blue-500 text-sm hover:underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Botón de Login -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Iniciar Sesión
                </button>

                <!-- Separador -->
                <div class="flex items-center my-6">
                    <hr class="flex-grow border-gray-300">
                    <span class="px-3 text-gray-500 text-sm">o</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                <!-- Registro -->
                @if (Route::has('register'))
                    <p class="text-sm text-gray-600 text-center">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Regístrate aquí</a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>
