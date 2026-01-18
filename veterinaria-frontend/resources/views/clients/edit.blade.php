@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Editar Cliente</h2>
            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Cancelar
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('clients.update', $client['id']) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $client['name'] ?? $client['nombre']) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label">Apellido <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $client['apellido']) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client['email']) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $client['telefono']) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad', $client['ciudad']) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $client['direccion']) }}" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold">Actualizar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection