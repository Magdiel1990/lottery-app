@extends('layouts.app')

@section('content')
    <div class="container form-container">
        <div class="justify-content-center text-center">
            <h3 class="mb-3">Probar tu Número</h3>
            <form id="loteriaForm" class="d-flex flex-column align-items-center">
                <input type="text" id="numero" class="form-control mb-3" placeholder="Ej: 12,15,17,..." required>
                <button type="submit" class="pruebaBtn">Probar</button>
            </form>
            <div class="resultado mt-3 fw-bold" id="resultado"></div>
        </div>
    </div>
@endsection
