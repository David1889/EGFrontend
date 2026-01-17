@forelse($clients as $client)
    <tr>
        <td>{{ $client['id'] ?? '#' }}</td>
        <td>
            {{ $client['name'] ?? ($client['nombre'] ?? 'Sin nombre') }} 
            {{ $client['apellido'] ?? '' }}
        </td>
        <td>{{ $client['email'] ?? '-' }}</td>
        <td>{{ $client['ciudad'] ?? '-' }}</td>
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-outline-primary" aria-label="Ver detalles de {{ $client['name'] ?? 'cliente' }}">Ver</a>
            <a href="#" class="btn btn-sm btn-outline-warning" aria-label="Editar detalles de {{ $client['name'] ?? 'cliente' }}">Editar</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center py-4">
            No hay clientes registrados.
        </td>
    </tr>
@endforelse