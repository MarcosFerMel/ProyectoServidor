<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Usuarios Registrados</h2>
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Nombre</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">{{ ucfirst($user->role) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
