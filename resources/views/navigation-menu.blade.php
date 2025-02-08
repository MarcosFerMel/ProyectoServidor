<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between">

            <!-- Logo Pegado -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo2.png') }}" alt="Altos de la Sierra" class="h-10 w-auto">
                </a>
            </div>

            <!-- Botón de Menú (Mobile) -->
            <div class="sm:hidden">
                <button @click="open = ! open" class="text-gray-700 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links (Movidos a la derecha) -->
            <div class="hidden sm:flex space-x-8 sm:ms-16">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <!-- Habitaciones (Admin y Usuario) -->
                @auth
                    @if(auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('admin.rooms') }}" :active="request()->routeIs('admin.rooms')">
                            {{ __('Habitaciones') }}
                        </x-nav-link>
                    @else
                        <x-nav-link href="{{ route('rooms') }}" :active="request()->routeIs('rooms')">
                            {{ __('Habitaciones') }}
                        </x-nav-link>
                    @endif
                @else
                    <x-nav-link href="{{ route('rooms') }}" :active="request()->routeIs('rooms')">
                        {{ __('Habitaciones') }}
                    </x-nav-link>
                @endauth

                @auth
                    <!-- Solo Usuarios Autenticados -->
                    <x-nav-link href="{{ route('reservations') }}" :active="request()->routeIs('reservations')">
                        {{ __('Reservas') }}
                    </x-nav-link>
                @endauth

                @auth
                    @if(auth()->user()->isAdmin())
                        <!-- Solo Administradores -->
                        <x-nav-link href="{{ route('seasons') }}" :active="request()->routeIs('seasons')">
                            {{ __('Temporadas') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                            {{ __('Usuarios') }}
                        </x-nav-link>
                    @endif
                @endauth
            </div>

            <!-- Settings Dropdown Pegado a la Derecha -->
            <div class="hidden sm:flex sm:items-center ms-auto">
                @auth
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}
                                            <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Cerrar sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Botón de Login si el usuario no está autenticado -->
                    <x-nav-link href="{{ route('login') }}">
                        {{ __('Iniciar Sesión') }}
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Móvil) -->
    <div x-show="open" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('rooms') }}" :active="request()->routeIs('rooms')">
                {{ __('Habitaciones') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link href="{{ route('reservations') }}" :active="request()->routeIs('reservations')">
                    {{ __('Reservas') }}
                </x-responsive-nav-link>
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link href="{{ route('seasons') }}" :active="request()->routeIs('seasons')">
                        {{ __('Temporadas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                        {{ __('Usuarios') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>
