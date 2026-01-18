@forelse($pets as $pet)
    <tr>
        <td>
            @if(!empty($pet['foto']))
                <img src="{{ $pet['foto'] }}" 
                    alt="Foto de {{ $pet['nombre'] }}" 
                    class="rounded-circle border" 
                    style="width: 50px; height: 50px; object-fit: cover; min-width: 50px;" 
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/50?text=Pet';">
            @else
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" 
                    style="width: 50px; height: 50px; min-width: 50px;">
                    <i class="bi bi-camera" aria-hidden="true"></i>
                </div>
            @endif
        </td>

        <td class="fw-bold">{{ $pet['nombre'] ?? 'Sin Nombre' }}</td>
        
        <td>{{ $pet['raza'] ?? '-' }}</td>
        
        <td>{{ $pet['color'] ?? '-' }}</td>
        
        <td>
            {{ !empty($pet['fecha_de_nac']) ? date('d/m/Y', strtotime($pet['fecha_de_nac'])) : '-' }}
        </td>

        <td class="text-end">
            <div class="d-flex gap-1 justify-content-end">
                
                <a href="{{ route('pets.edit', $pet['id']) }}" 
                    class="btn btn-sm btn-outline-warning" 
                    aria-label="Editar datos de {{ $pet['nombre'] }}">
                    <i class="bi bi-pencil" aria-hidden="true"></i> Editar
                </a>

                <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" 
                    onsubmit="return confirm('¿Confirma que desea eliminar a {{ $pet['nombre'] }} del sistema?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Eliminar a {{ $pet['nombre'] }}">
                        <i class="bi bi-trash" aria-hidden="true"></i> Eliminar
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4 text-muted">
            No hay mascotas registradas en el sistema.
        </td>
    </tr>
@endforelse