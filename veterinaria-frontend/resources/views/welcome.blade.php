@extends('layouts.app') 

@section('title', 'Inicio')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm border">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-primary">Veterinaria San Antón</h1>
            <p class="col-md-8 fs-4">Cuidado integral para tu mascota en la ciudad de Rosario.</p>
            <p>Ofrecemos servicios de medicina, cirugía, peluquería y hospitalización con profesionales de primer nivel.</p>
            <a href="#" class="btn btn-primary btn-lg" type="button">Ingresar al Sistema</a>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-4 mb-4">
            <div class="h-100 p-4 text-white bg-dark rounded-3 shadow-sm">
                <h2>🩺 Medicina</h2>
                <p>Consultas, vacunación, rayos X y cirugías. Contamos con tres veterinarios titulados para la mejor atención de perros, gatos y exóticos.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="h-100 p-4 bg-white border rounded-3 shadow-sm">
                <h2>✂️ Estética</h2>
                <p>Servicios de baño y peluquería. Nuestros especialistas detectan problemas en la piel durante el servicio para derivar al veterinario.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="h-100 p-4 text-white bg-secondary rounded-3 shadow-sm">
                <h2>🏥 Internación</h2>
                <p>Servicios de hospitalización y hotelería con monitoreo. Registro detallado de estadías y cuidados especiales.</p>
            </div>
        </div>
    </div>
@endsection