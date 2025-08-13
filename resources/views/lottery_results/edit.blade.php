@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm w-50 mx-auto">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-center"><i class="bi bi-pencil-square me-2"></i>Editar Jugada</h5>
        </div>
        <div class="card-body">
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
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-45">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
