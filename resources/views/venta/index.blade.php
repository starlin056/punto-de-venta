@extends('layouts.app')

@section('title','ventas')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .row-not-space {
        width: 110px;
    }
</style>
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

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Ventas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Ventas</li>
    </ol>

    @can('crear-venta')
    <div class="mb-4">
        <a href="{{ route('ventas.create') }}">
            <button type="button" class="btn btn-primary">Crear venta</button>
        </a>

        <a href="{{ route('export.excel-ventas-all') }}">
            <button type="button" class="btn btn-danger">Exportar en Excel</button>
        </a>
    </div>
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla ventas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Comprobante</th>
                        <th>Cliente</th>
                        <th>Fecha y hora</th>
                        <th>Vendedor</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $item)
                    <tr>
                        <td>
                            <p class="fw-semibold mb-1">
                                {{ $item->comprobante->tipo_comprobante }}
                            </p>
                            <p class="text-muted mb-0">
                                {{ $item->numero_comprobante }}
                            </p>
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">
                                {{ ucfirst($item->cliente->persona->tipo_persona) }}
                            </p>
                            <p class="text-muted mb-0">
                                {{ $item->cliente->persona->razon_social }}
                            </p>
                        </td>
                        <td>
                            <div class="row-not-space">
                                <p class="fw-semibold mb-1">
                                    <span class="m-1"><i class="fa-solid fa-calendar-days"></i></span>
                                    {{ $item->fecha }}
                                </p>
                                <p class="fw-semibold mb-0">
                                    <span class="m-1"><i class="fa-solid fa-clock"></i></span>
                                    {{ $item->hora }}
                                </p>
                            </div>
                        </td>
                        <td>
                            {{ $item->user->name }}
                        </td>
                        <td>

                            RD$ {{ number_format($item->total,  2, '.', ',') }}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="gap: 05px;">
                                @can('mostrar-venta')
                                <form action="{{ route('ventas.show', ['venta' => $item]) }}" method="get">
                                    <button type="submit" class="btn btn-success">
                                        Ver
                                    </button>
                                </form>
                                @endcan

                                <!-- pdf ver -->
                                <a type="button" class="btn btn-danger"
                                    href="{{ route('export.pdf-comprobante-venta',['id' => Crypt::encrypt($item->id)]) }}"
                                    target="_blank"> IMPRIMIR FACTURA </a>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple", {})
    });
</script>
@endpush