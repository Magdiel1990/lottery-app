@extends("layouts.app")

@section("content")
<div class="container mt-4">
    <div class="card shadow-sm w-50 mx-auto">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Agregar nuevo resultado</h5>
        </div>
        <div class="card-body">
            <form action="/store" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="draw_date" class="form-label">Fecha del sorteo</label>
                    <input type="date" name="draw_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="numbers" class="form-label">Jugada (separada por coma)</label>
                    <input type="text" name="numbers" class="form-control" placeholder="12,23,34,45,56,67" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
