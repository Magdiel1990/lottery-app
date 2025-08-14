@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-2 text-center">Jugadas</h2>

        <div class="row g-4 my-2">
            <?php $i = 1;?>
            @forelse($resultsSet as $result)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr># {{$i}}</tr>
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
                <?php $i++; ?>
            @empty
                <div class="d-flex justify-content-center">
                    <div class="alert alert-warning text-center shadow-sm w-100" style="max-width: 600px;" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        No hay jugadas disponibles
                    </div>
                </div>
            @endforelse
        </div>
    @endsection
