@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Carousel de bienvenida --}}
    <div id="bienvenidaCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1200x400/?lottery,success" class="d-block w-100" alt="Bienvenida">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="text-light fw-bold">¡Bienvenido!</h1>
                    <p class="fs-5">Administra y visualiza resultados de tus loterías favoritas.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de cards de loterías --}}
    <h2 class="mb-4 text-center">Loterías disponibles</h2>

    <div class="row justify-content-center">
        @forelse($loterias as $loteria)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold text-primary">{{ $loteria->nombre }}</h5>
                        <p class="card-text">{{ $loteria->descripcion }}</p>
                        <a href="{{ route('loterias.show', $loteria->id) }}" class="btn btn-outline-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-6 text-center">
                <div class="alert alert-info">No hay loterías registradas aún.</div>
            </div>
        @endforelse
    </div>
<!--
    <div class="text-center mt-4">
        <a href="#" class="btn btn-success">Agregar nueva lotería</a>
    </div> -->
</div>
@endsection
