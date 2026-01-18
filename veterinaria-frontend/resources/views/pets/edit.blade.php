@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Editar Paciente</h2>
            <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary">
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

                <form method="POST" action="{{ route('pets.update', $pet['id']) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="cliente_id" class="form-label fw-bold">Dueño <span class="visually-hidden">(obligatorio)</span></label>
                        <select class="form-select" id="cliente_id" name="cliente_id" required>
                            @foreach($clients as $client)
                                <option value="{{ $client['id'] }}" 
                                    {{ (old('cliente_id', $pet['cliente_id']) == $client['id']) ? 'selected' : '' }}>
                                    {{ $client['name'] ?? $client['nombre'] }} {{ $client['apellido'] ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre Paciente <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $pet['nombre']) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_de_nac" class="form-label">Fecha de Nacimiento <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="date" class="form-control" id="fecha_de_nac" name="fecha_de_nac" 
                                   value="{{ old('fecha_de_nac', substr($pet['fecha_de_nac'] ?? '', 0, 10)) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="raza" class="form-label">Raza / Especie <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="raza" name="raza" value="{{ old('raza', $pet['raza']) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="color" class="form-label">Color <span class="visually-hidden">(obligatorio)</span></label>
                            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $pet['color']) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">URL de la Foto</label>
                        <input type="url" class="form-control" id="foto" name="foto" value="{{ old('foto', $pet['foto']) }}">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold">Actualizar Paciente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection