@extends('layouts.app')

@section('title', 'Perfil')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Acceso denegado',
        text: "{{ session('error') }}"
    });
</script>
@endif

<!-- parte de ventana de confirmacion -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<div class="container-fluid">
    <h1 class="mt-4 mb-4 text-center">Configurar perfil</h1>

    <div class="card">
        <div class="card-header">
            <p class="lead">Configure y personalice su perfil</p>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update', ['profile' => auth()->user()]) }}" method="POST">
                @method('PATCH')
                @csrf

                <div class="row g-4">
                    <!-- Nombre -->
                    <div class="col-12">
                        <x-forms.input 
                            id="name"
                            required="true"
                            labelText="Nombre de usuario"
                            :defaultValue="auth()->user()->name" />
                    </div>

                    <!-- Correo electrónico -->
                    <div class="col-12">
                        <x-forms.input 
                            id="email"
                            required="true"
                            type="email"
                            labelText="Correo electrónico"
                            :defaultValue="auth()->user()->email" />
                    </div>

                    <!-- Nueva contraseña -->
                    <div class="col-12">
                        <x-forms.input 
                            id="password"
                            type="password"
                            labelText="Nueva contraseña (opcional)" />
                    </div>

                    <!-- Botón -->
                    <div class="col text-center">
                        <input class="btn btn-success" type="submit" value="Guardar cambios">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('js')
@endpush
