@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- Resultados por páginas-->
        <form method="GET" class="mb-3">
            <label for="per_page">Ver:</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()">
                @foreach([6, 12, 18] as $size)
                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            resultados por página
        </form>

        <h2 class="my-2 text-center">Jugadas</h2>

        <div class="row g-4 my-2">
            @php $i = $resultsSet->count(); @endphp
            @forelse($resultsSet as $result)
                <div class="col-md-auto col-sm-auto col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr> # {{ $i}}</tr>
                                    <tr>
                                        <th>Categoría</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $categoria => $valor)
                                        <tr>
                                            <td>{{ ucfirst($categoria) }}</td>
                                            <td>{{ $valor }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @php $i--; @endphp
            @empty
                <div class="d-flex justify-content-center">
                    <div class="alert alert-warning text-center shadow-sm w-100" style="max-width: 600px;" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        No hay jugadas disponibles
                    </div>
                </div>
            @endforelse
        </div>

        <!--Paginación-->
        <div class="d-flex justify-content-center mt-4">
            {{ $lotteryResults->appends(['per_page' => $perPage])->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
