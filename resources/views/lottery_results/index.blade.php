@extends("layouts.app")

@section("content")

    <div class="text-end">
        <a href="{{ route('resultados.agregar') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i>
        </a>
    </div>

    <h1 class="text-center fs-2 my-2 py-2">Resultados Loto</h1>

    @if(session('success'))
        <p style="color: green;">{{ session ('success')}}</p>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered table-striped shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Resultado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($results as $result)
                    <tr>
                        <td>{{ $result->draw_date->format('Y-m-d') }}</td>
                        <td>
                            {{ implode(', ', $result->numbers) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No hay resultados!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
