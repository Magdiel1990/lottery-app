@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Loterías Disponibles</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($loterias as $loteria)
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">{{ ucfirst($loteria->nombre) }}</h5>
                    <p class="card-text">{{ Str::limit($loteria->requisitos, 100) }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('loterias.show', $loteria->id) }}" class="btn btn-primary w-100">
                        Ver Resultados
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
