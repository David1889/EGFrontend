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
            <div class="d-flex gap-1 justify-content-end">
                <a href="#" class="btn btn-sm btn-outline-primary" aria-label="Ver detalles de {{ $client['name'] ?? 'cliente' }}">Ver</a>
                <a href="{{ route('clients.edit', $client['id']) }}" 
                class="btn btn-sm btn-outline-warning" 
                aria-label="Editar datos de {{ $client['name'] ?? ($client['nombre'] ?? 'cliente') }}">
                Editar
                </a>
                <form action="{{ route('clients.destroy', $client['id']) }}" method="POST" 
                        onsubmit="return confirm('¿Está seguro que desea eliminar a este cliente? Esta acción podría no ser reversible.');">
                        @csrf
                        @method('DELETE') <button type="submit" class="btn btn-sm btn-outline-danger"
                                aria-label="Eliminar a {{ $client['name'] ?? ($client['nombre'] ?? 'cliente') }}">
                            <i class="bi bi-trash" aria-hidden="true"></i> Eliminar
                        </button>
                </form>   
            </div>     
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center py-4">
            No hay clientes registrados.
        </td>
    </tr>
@endforelse
