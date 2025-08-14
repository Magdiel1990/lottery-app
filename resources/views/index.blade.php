@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-2 text-center">Loterías Disponibles</h2>

    <div class="row g-4 my-2">
        @forelse($loterias as $loteria)
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-center text-danger">
                        {{ ucfirst($loteria->nombre) }}
                    </h5>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total de bolos</span>
                            <span class="fw-bold">{{ $loteria->total }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Mínimo valor</span>
                            <span class="fw-bold text-primary">{{ $loteria->minValue }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Máximo valor</span>
                            <span class="fw-bold text-danger">{{ $loteria->maxValue }}</span>
                        </li>
                    </ul>
                    <p class="card-text m-2 p-3 bg-light rounded shadow-sm border-start border-4 border-primary">
                        <em>{{ $loteria->descripcion }}</em>
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('loteria.show', $loteria->id) }}" class="btn btn-primary w-100 mt-2">
                        Ver
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="d-flex justify-content-center">
            <div class="alert alert-warning text-center shadow-sm w-100" style="max-width: 600px;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Aún no hay loterías disponibles.
            </div>
        </div>

        @endforelse
    </div>
</div>
@endsection
