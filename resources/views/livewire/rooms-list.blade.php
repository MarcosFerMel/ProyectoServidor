<div>
    <h2 class="text-xl font-bold mb-4">Habitaciones Disponibles</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Capacidad</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Precio</th>
                <th class="px-4 py-2">Temporada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td class="border px-4 py-2">{{ $room->name }}</td>
                    <td class="border px-4 py-2">{{ $room->capacity }}</td>
                    <td class="border px-4 py-2">{{ $room->type }}</td>
                    <td class="border px-4 py-2">${{ $room->price }}</td>
                    <td class="border px-4 py-2">{{ $room->season->name ?? 'Sin temporada' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
