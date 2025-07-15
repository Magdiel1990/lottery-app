@extends("layouts.app")

@section("content")
    <h1>Resultados Loto</h1>

    <a href="{{route ('resultados.agregar')}}"> Agregar nuevo resultado</a>

    @if(session('success'))
        <p style="color: green;">{{ session ('success')}}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Jugada</th>
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
                    <td colspan="2">No hay resultados!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
