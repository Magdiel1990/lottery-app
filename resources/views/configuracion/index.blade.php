@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height: 80vh;">
    <div class="w-100" style="max-width: 800px;">
        {{-- Formulario de configuración --}}
        <div class="card shadow-lg p-4 mb-4">
            <h3 class="text-center mb-4 text-primary">
                <i class="bi bi-gear-fill"></i> Configuración de Lotería
            </h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('loterias.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Lotería</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Loto Leidsa" required>
                </div>

                <div class="mb-3">
                    <label for="minValue" class="form-label">
                        Valor mínimo permitido: <span id="minValueLabel">1</span>
                    </label>
                    <input type="range" class="form-range" id="minValue" name="minValue" min="1" max="100" value="1" oninput="document.getElementById('minValueLabel').innerText = this.value">
                </div>

                <div class="mb-3">
                    <label for="maxValue" class="form-label">
                        Valor máximo permitido: <span id="maxValueLabel">40</span>
                    </label>
                    <input type="range" class="form-range" id="maxValue" name="maxValue" min="1" max="100" value="40" oninput="document.getElementById('maxValueLabel').innerText = this.value">
                </div>

                <div class="mb-4">
                    <label for="total" class="form-label">
                        Total de bolos: <span id="totalLabel">6</span>
                    </label>
                    <input type="range" class="form-range" id="total" name="total" min="1" max="80" value="6" oninput="document.getElementById('totalLabel').innerText = this.value">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Breve descripción de la lotería..."></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>

        {{-- Lista de loterías existentes --}}
        <div class="card shadow-sm p-4">
            <h5 class="mb-3 text-secondary"><i class="bi bi-list-ul"></i> Loterías registradas</h5>

            @if($loterias->isEmpty())
                <p class="text-muted">No hay loterías registradas aún.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Total</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loterias as $loteria)
                                <tr>
                                    <td>{{ $loteria->nombre }}</td>
                                    <td>{{ $loteria->minValue }}</td>
                                    <td>{{ $loteria->maxValue }}</td>
                                    <td>{{ $loteria->total }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('loterias.edit', $loteria->id) }}" class="btn btn-sm btn-warning me-2">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>

                                        <form action="{{ route('loterias.destroy', $loteria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta lotería?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
