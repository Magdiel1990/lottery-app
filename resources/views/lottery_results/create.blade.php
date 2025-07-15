@extends("layouts.app")

@section("content")
    <form action="#" method="POST">
        @csrf
        <label for="draw_date">Fecha:</label>
        <input type="date" name="draw_date" required><br>

        <label for="numbers">Jugada (separada por coma):</label>
        <input type="text" placeholder="12,23,34,45,56,67" name="numbers" required><br>

        <button type="submit">Guardar</button>
    </form>
@endsection



