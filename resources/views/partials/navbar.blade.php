<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
        <i class="bi bi-bar-chart-line"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLotoApp" aria-controls="navbarLotoApp" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarLotoApp">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cloud-arrow-down"></i> Importar Datos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-cloud-arrow-up"></i> Exportar Datos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('configuracion.index') }}">
                        Configuración
                    </a>
                </li>
            </ul>
            @if (Route::currentRouteName() === 'loteria.show')
                <form class="d-flex" method="GET" action="{{ route('loteria.show', $loteria->id) }}" role="search">
                    <input class="form-control me-2" name="fecha" type="date" value="{{ request('fecha') }}">
                    <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
            @endif
        </div>
    </div>
</nav>
