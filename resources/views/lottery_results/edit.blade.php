@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4 w-100" style="max-width: 500px;">
        <h2 class="text-center mb-4">Editar Jugada</h2>

        <form action="{{ route('loto.update', $lotoleidsa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="draw_date" class="form-label">Fecha del Sorteo</label>
                <input type="date" name="draw_date" id="draw_date" class="form-control" value="{{ $lotoleidsa->draw_date->format('Y-m-d') }}">
            </div>

            <div class="mb-3">
                <label for="numbers" class="form-label">Números (separados por comas)</label>
                <input type="text" name="numbers" id="numbers" class="form-control" value="{{ implode(',', $lotoleidsa->numbers) }}">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success w-45">Actualizar</button>
                <a href="{{ route('loterias.show', $lotoleidsa) }}" class="btn btn-outline-secondary w-45">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
