@extends('layouts.app')

@section('title', 'Productos')

@push('css-datatable')
<!-- Incluimos el CSS necesario para las tablas -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<!-- Incluimos el script de SweetAlert2 para las alertas -->
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
<!--resto del code-->
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    <!-- Botón para crear un nuevo producto, restringido por el permiso 'crear-producto' -->
    @can('crear-producto')
    <div class="mb-4">
        <a href="{{ route('productos.create') }}">
            <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
        </a>
    </div>
    @endcan

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla productos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>

                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteramos sobre los productos para mostrarlos en la tabla -->
                    @foreach ($productos as $item)
                    <tr>

                        <td>{{ $item->nombreCompleto }}</td>
                        <td>{{ $item->precio !== null ? 'RD$ ' . number_format($item->precio, 2, '.', ',') : 'No aperturado' }}</td>
                        <td>{{ $item->marca->caracteristica->nombre ?? 'Sin marca' }}</td>
                        <td>{{ $item->categoria->caracteristica->nombre ?? 'Sin categoría' }}</td>
                        <td>
                            <!-- Mostramos el estado como un badge (activo/inactivo) -->
                            <span class="badge rounded-pill text-bg-{{ $item->estado ? 'success' : 'danger' }}">
                                {{ $item->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <div>
                                    <!-- Botón de opciones (dropdown) -->
                                    <button title="Opciones" class="btn btn-datatable btn-icon btn-transparent-dark me-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-vertical" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                            <path fill="currentColor" d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                        @can('editar-producto')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('productos.edit', ['producto' => $item]) }}">Editar</a>
                                        </li>
                                        @endcan
                                        @can('ver-producto')
                                        <li>
                                            <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#verModal-{{ $item->id }}">Ver</a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                                <div>
                                    <div class="vr"></div>
                                </div>
                                <div>
                                    <!-- Formulario para inicializar el producto -->
                                    <form action="{{ route('inventario.create') }}" method="get">
                                        <!-- Incluimos un input oculto con el ID del producto -->
                                        <input type="hidden" name="producto_id" value="{{ $item->id}}">
                                        <button title="Inicializar"
                                            class="btn btn-datatable btn-icon btn-transparent-dark"
                                            type="submit">
                                            <i class="fa-solid fa-rotate"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal para ver detalles del producto -->
                    <div class="modal fade" id="verModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles del producto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p><span class="fw-bolder">Descripción: </span>{{ $item->descripcion ?? 'No tiene' }}</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bolder">Imagen:</p>
                                            <div>
                                                @if ($item->img_path != null)
                                                <img src="{{ asset($item->img_path) }}"
                                                    alt="{{ $item->nombre }}"
                                                    class="img-fluid img-thumbnail border border-4 rounded">
                                                @else
                                                <img src="" alt="{{ $item->nombre }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
<!-- Scripts necesarios para el DataTable -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush