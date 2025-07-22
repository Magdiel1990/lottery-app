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
                    <td style="color: #34495e; font-weight: bold;">
                        {{ $result->draw_date->format('Y-m-d') }}
                    </td>

                    <td style="color: #2c3e50; font-weight: bold;">
                        {{ implode(' - ', $result->numbers) }}
                    </td>

                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="#" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este resultado?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
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
