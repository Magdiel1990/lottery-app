@extends('layouts.app')

@section('content')
<!--
       1) Seccion para probar si el numero se puede jugar
       2) Seccion donde se mostrara las estadisticas en tiempo real de esa loteria
       3) Seccion para la probabilidad de ganarla
       4) Seccion para generar un numero aleatorio que tenga probabilidad de salir (porque cumple con los patrones)
       5) Seccion para generar un numero aleatorio que tenga probabilidad de salir (porque no cumple con los patrones)
        6) Seccion para mostrar la grafica de los numeros que han salido
        7) Sección de tendencias (muestra los numeros o combinaciones de numeros calientes y frios)
        8) Sección de análisis inverso (Entras un numero o mas numeros y te dice cuando salio por ultima vez)
        9) Sección de simulación de jugadas (pone a prueba la jugada a ver la probabilidad de salir)
       -->
<!-- Bootstrap 5 CSS -->

<div id="loteriaCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Probar Número</h5>
                        <p class="card-text">Verifica si el número se puede jugar según tus criterios.</p>
                        <a href="{{ route('analize.probar_numero', $id) }}" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Estadísticas en Tiempo Real</h5>
                        <p class="card-text">Monitorea los datos en vivo de esta lotería.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Probabilidad de Ganar</h5>
                        <p class="card-text">Calcula las probabilidades actuales de éxito.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Número Aleatorio (Con Patrones)</h5>
                        <p class="card-text">Genera un número que cumple con patrones favorables.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Número Aleatorio (Sin Patrones)</h5>
                        <p class="card-text">Genera un número sin cumplir patrones.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Gráfica de Números</h5>
                        <p class="card-text">Visualiza los números más frecuentes.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Tendencias</h5>
                        <p class="card-text">Consulta números calientes y fríos.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Análisis Inverso</h5>
                        <p class="card-text">Revisa la última aparición de un número.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
                <div class="card text-center shadow card-item">
                    <div class="card-body">
                        <h5 class="card-title">Simulación de Jugadas</h5>
                        <p class="card-text">Pon a prueba tu jugada y su probabilidad.</p>
                        <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Controles del Carousel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#loteriaCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#loteriaCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endsection
