@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center py-5">
    <div class="w-50">
        <!-- Resultados por páginas-->
        <form method="GET" class="mb-3">
            <label for="per_page">Ver:</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()">
                @foreach([5, 10, 25, 50] as $size)
                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            resultados por página
        </form>

        <!--Botón de agregar-->
        <div class="text-end">
            <a href="{{ route('loto.agregar') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i>
            </a>
        </div>
    </div>

    <h2 class="mb-4 text-center">{{ $loteria->nombre }}</h2>

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
        <!--Paginación-->
        <div class="d-flex justify-content-center">
            {{ $results->appends(['per_page' => $perPage])->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
