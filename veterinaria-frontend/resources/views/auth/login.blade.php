@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center py-3">
                <h4 class="mb-0 text-primary fw-bold">Ingreso al Sistema</h4>
            </div>
            
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf <div class="mb-3">
                        <label for="email" class="form-label text-secondary">Correo Electrónico</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-secondary">Contraseña</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary fw-bold">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center bg-light py-3">
                <small class="text-muted">Veterinaria San Antón</small>
            </div>
        </div>
    </div>
</div>
@endsection