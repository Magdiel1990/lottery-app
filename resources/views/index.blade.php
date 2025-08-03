@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">Loterías Disponibles</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4 my-4">
        @foreach($loterias as $loteria)
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-center text-danger">
                        {{ ucfirst($loteria->nombre) }}
                    </h5>
                    <ul class="card-text">
                        <li>Total de bolos: {{ $loteria->total }}</li>
                        <li>Mínimo valor: {{ $loteria->minValue }}</li>
                        <li>Máximo valor: {{ $loteria->maxValue }}</li>
                    </ul>
                    <p class="card-text mx-2">{{ $loteria->descripcion }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('loterias.show', $loteria->id) }}" class="btn btn-primary w-100">
                        Entrar
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
