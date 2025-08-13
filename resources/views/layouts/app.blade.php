<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- SEO -->
        <meta name="description" content="Lottap - Análisis y predicciones para loterías con estadísticas en tiempo real.">
        <meta name="keywords" content="lotería, estadísticas, probabilidades, simulación, números calientes, números fríos">
        <meta name="author" content="Magdiel Castillo">

        <!-- Open Graph (para compartir en redes sociales) -->
        <meta property="og:title" content="Lottap">
        <meta property="og:description" content="Análisis y predicciones para loterías con estadísticas en tiempo real.">
      <!--  <meta property="og:image" content="{{ asset('images/preview.jpg') }}"> -->
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:type" content="website">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Estilos personalizados -->
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
       
        <!-- Optimización: Preconexión a CDN -->
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com">

        <title>Lottap</title>
    </head>
    <body>
        @include('partials.navbar')

        <main class="container my-4">
            <!-- Caja de Mensaje -->
            @include('partials.alert')

            <!-- Contenido -->
            @yield("content")
        </main>

        @include('partials.footer')
    </body>
</html>
