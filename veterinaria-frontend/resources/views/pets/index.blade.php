@extends('layouts.app')

@section('title', 'Gestión de Mascotas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Pacientes (Mascotas)</h2>
    <a href="{{ route('pets.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg" aria-hidden="true"></i> Nueva Mascota
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 80px;">Foto</th> <th scope="col">Nombre</th>
                    <th scope="col">Raza / Especie</th>
                    <th scope="col">Color</th>
                    <th scope="col">Nacimiento</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody id="pets-container" aria-live="polite" aria-atomic="true">
                <tr id="loading-spinner">
                    <td colspan="6" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando pacientes...</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ route('pets.list') }}")
            .then(response => response.text())
            .then(html => {
                document.getElementById('pets-container').innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('pets-container').innerHTML = 
                    '<tr><td colspan="6" class="text-center text-danger">No se pudo cargar la lista.</td></tr>';
            });
    });
</script>
@endsection