<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Estilo CSS-->
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
