<div>
    <h2 class="text-xl font-bold mb-4">Reservas</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Usuario</th>
                <th class="px-4 py-2">Habitación</th>
                <th class="px-4 py-2">Fecha de Entrada</th>
                <th class="px-4 py-2">Fecha de Salida</th>
                <th class="px-4 py-2">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td class="border px-4 py-2">{{ $reservation->user->name }}</td>
                    <td class="border px-4 py-2">{{ $reservation->room->name }}</td>
                    <td class="border px-4 py-2">{{ $reservation->check_in }}</td>
                    <td class="border px-4 py-2">{{ $reservation->check_out }}</td>
                    <td class="border px-4 py-2">{{ $reservation->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
