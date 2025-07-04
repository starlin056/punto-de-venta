@extends('layouts.app')

@section('title','Empleados')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<!-- SweetAlert2 para notificaciones -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .img-thumb {
        width: 80px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Empleados</h1>

    {{-- Breadcrumb --}}
    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item active="true" content="Empleados" />
    </x-breadcrumb.template>

    {{-- Botón Crear --}}
    <div class="mb-4">
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            Añadir nuevo registro
        </a>
    </div>



    {{-- Alertas de sesión --}}
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
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

    {{-- Tabla --}}
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Tabla de Empleados
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Nombre y Apellidos</th>
                        <th>Cargo</th>
                        <th>Imagen</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $item)
                    <tr>

                        <td>{{ $item->razon_social }}</td>
                        <td>{{ $item->cargo }}</td>
                        <td class="text-center">
                            @if($item->img && Storage::disk('public')->exists($item->img))
                            <img
                                src="{{ Storage::url($item->img) }}"
                                alt="{{ $item->razon_social }}"
                                class="img-thumbnail img-thumb mx-auto d-block">
                            @else
                            <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td class="text-center">
                            <a href="{{ route('empleados.edit', $item) }}"
                                class="btn btn-sm btn-warning me-2">
                                Editar
                            </a>
                            <form
                                action="{{ route('empleados.destroy', $item) }}"
                                method="POST"
                                style="display:inline"
                                onsubmit="return confirm('¿Eliminar este empleado?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Borrar
                                </button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- subir archivo para empleado macivos -->
        <div class="card-footer">

            <form action="{{ route('import.excel-empleados') }}" method="post" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="mb-3"
                    <label for="file" class="form-label">Subir archivo</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-success"> Importar datos</button>
            </form>
        </div>
    </div>

</div>


@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush