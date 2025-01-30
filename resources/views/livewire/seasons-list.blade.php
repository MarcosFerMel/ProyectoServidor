<div>
    <h2 class="text-xl font-bold mb-4">Temporadas</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Inicio</th>
                <th class="px-4 py-2">Fin</th>
                <th class="px-4 py-2">Multiplicador de Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td class="border px-4 py-2">{{ $season->name }}</td>
                    <td class="border px-4 py-2">{{ $season->start_date }}</td>
                    <td class="border px-4 py-2">{{ $season->end_date }}</td>
                    <td class="border px-4 py-2">{{ $season->price_multiplier }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
