@if ($errors->any() || session('success'))
    <div class="d-flex justify-content-center mt-3">
        <div
            class="alert alert-dismissible fade show text-center w-auto
                   {{ $errors->any() ? 'alert-danger' : 'alert-success' }}"
            role="alert"
        >
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="mb-0 p-2 me-4">{{ $error }}</p>
                @endforeach
            @else
                {{ session('success') }}
            @endif

            <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    </div>
@endif
