@extends('layouts.app')

@section('title', 'Listado de Clientes')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

<div class="card shadow-sm border-0"> ...
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Gestión de Clientes</h2>
    <a href="{{ route('clients.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nuevo Cliente
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody id="clients-container" aria-live="polite" aria-atomic="true">
                <tr id="loading-spinner">
                    <td colspan="5" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando datos...</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Hacemos una petición interna a nuestro propio controlador
        fetch("{{ route('clients.list') }}")
            .then(response => response.text()) // Esperamos texto HTML
            .then(html => {
                // Ocultamos el spinner y pegamos las filas que llegaron
                document.getElementById('clients-container').innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('clients-container').innerHTML = 
                    '<tr><td colspan="5" class="text-center text-danger">Error al cargar la lista.</td></tr>';
            });
    });
</script>
@endsection