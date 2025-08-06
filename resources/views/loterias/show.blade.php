{{-- resources/views/loterias/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $loteria->nombre }}</h2>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Total de bolos:</strong> {{ $loteria->total }}</li>
        <li class="list-group-item"><strong>Valor mínimo:</strong> {{ $loteria->minValue }}</li>
        <li class="list-group-item"><strong>Valor máximo:</strong> {{ $loteria->maxValue }}</li>
        <li class="list-group-item"><strong>Descripción:</strong> {{ $loteria->descripcion ?? 'Sin descripción' }}</li>
    </ul>

    <a href="{{ route('home') }}" class="btn btn-secondary">← Volver</a>
</div>
@endsection
