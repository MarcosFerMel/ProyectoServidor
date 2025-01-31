<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (request()->routeIs('rooms'))
            <livewire:rooms />
        @elseif (request()->routeIs('reservations'))
            <livewire:reservations />
        @elseif (request()->routeIs('seasons'))
            <livewire:seasons />
        @elseif (request()->routeIs('users'))
            <livewire:users />
        @else
            <h2 class="text-xl font-bold">Bienvenido al Panel de Administración</h2>
            <p>Selecciona una opción del menú para comenzar.</p>
        @endif
    </div>
</x-app-layout>
