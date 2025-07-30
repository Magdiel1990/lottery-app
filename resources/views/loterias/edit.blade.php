@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 w-100" style="max-width: 600px;">
        <h3 class="text-center mb-4 text-primary">
            <i class="bi bi-pencil-square"></i> Editar Lotería
        </h3>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('loterias.update', $loteria->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Lotería</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $loteria->nombre) }}" required>
            </div>

            {{-- Valor mínimo --}}
            <div class="mb-3">
                <label for="minValue" class="form-label">
                    Valor mínimo permitido: <span id="minValueLabel">{{ $loteria->minValue }}</span>
                </label>
                <input type="range" class="form-range" id="minValue" name="minValue" min="1" max="100" value="{{ $loteria->minValue }}" oninput="document.getElementById('minValueLabel').innerText = this.value">
            </div>

            {{-- Valor máximo --}}
            <div class="mb-3">
                <label for="maxValue" class="form-label">
                    Valor máximo permitido: <span id="maxValueLabel">{{ $loteria->maxValue }}</span>
                </label>
                <input type="range" class="form-range" id="maxValue" name="maxValue" min="1" max="100" value="{{ $loteria->maxValue }}" oninput="document.getElementById('maxValueLabel').innerText = this.value">
            </div>

            {{-- Total de bolos --}}
            <div class="mb-4">
                <label for="total" class="form-label">
                    Total de bolos a jugar: <span id="totalLabel">{{ $loteria->total }}</span>
                </label>
                <input type="range" class="form-range" id="total" name="total" min="1" max="20" value="{{ $loteria->total }}" oninput="document.getElementById('totalLabel').innerText = this.value">
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Actualizar Lotería
                </button>
            </div>

            <div class="d-grid">
                <a href="{{ route('configuracion.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Volver a la lista
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
