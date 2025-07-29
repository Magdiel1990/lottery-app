@extends("layouts.app")

@section("content")

    <div class="text-end">
        <a href="{{ route('loto.agregar') }}" class="btn btn-success">
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
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                        @foreach ($result->numbers as $number)
                            <div class="bola">{{ $number }}</div>
                        @endforeach
                        </div>
                    </td>

                    <td style="color: #34495e; font-weight: bold;">
                        {{ $result->draw_date->format('d-M-Y') }}
                    </td>

                    <td>
                        <a href="{{ route('loto.editar', $result->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('loto.delete', $result->id)}}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar esta jugada?');">
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
