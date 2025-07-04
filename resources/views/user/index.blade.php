@extends('layouts.app')

@section('title','usuarios')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@endpush

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

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
  <!-- para delimitar las vistas de los moduelos -->
    @can('crear-user') 
    <div class="mb-4">
        <a href="{{ route('users.create') }}">
            <button type="button" class="btn btn-primary">Añadir nuevo usuario</button>
        </a>
    </div>
    @endcan

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de usuarios
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Alias</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->empleado ? $item->empleado->razon_social : 'Sin información' }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->getRoleNames()->first() }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $item->estado == 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                                {{ $item->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around align-items-center">
                                <div class="dropdown">
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        @can('editar-user')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('users.edit', ['user' => $item]) }}">
                                                Editar
                                            </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                                <div class="vr mx-2"></div>
                                @can('eliminar-user')
                                <button 
                                    title="{{ $item->estado == 1 ? 'Desactivar' : 'Restaurar' }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmModal-{{ $item->id }}" 
                                     class="btn btn-datatable btn-icon {{ $item->estado == 1 ? 'btn-darck' : 'btn-danger' }}">
                                    @if ($item->estado == 1)
                                        <i class="material-icons">delete_sweep</i>
                                    @else
                                        <i class="fa-regular fa-trash-can-undo"></i>
                                       
                                    @endif
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de confirmación -->
                    <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel-{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="confirmModalLabel-{{ $item->id }}">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->estado == 1
                                        ? '¿Seguro que quiere desactivar el usuario?'
                                        : '¿Seguro que quiere restaurar el usuario?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('users.destroy', ['user' => $item->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn {{ $item->estado == 1 ? 'btn-danger' : 'btn-success' }}">
                                            Confirmar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
