@extends('layouts.app')

@section('title','cajas')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Uups...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#d33',
    });
</script>
@endif


@section('content')

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
    <h1 class="mt-4 text-center">cajas</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href=" route('panel') " content="Inicio" />
        <x-breadcrumb.item active='true' content="cajas" />
    </x-breadcrumb.template>

    @can('aperturar-caja')
    <div class="mb-4">
        <a href="{{route('cajas.create')}}">
            <button type="button" class="btn btn-primary">Aperturar caja</button>
        </a>
    </div>
    @endcan


    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla cajas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apertura</th>
                        <th>Cierre</th>
                        <th>saldo inicial</th>
                        <th>saldo final</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cajas as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>
                            <p class="fw-semibold mb-1">
                                <span class="m-1"><i class="fa-solid fa-calendar-day"></i></span> {{ $item->fecha }}
                            </p>
                            <p class="fw-semibold mb-0">
                                <span class="m-1"><i class="fa-solid fa-clock"></i></span> {{ $item->hora }}
                            </p>
                        </td>
                        <td>
                            @if ($item->fecha_hora_cierre)
                            <p class="fw-semibold mb-1">
                                <span class="m-1"><i class="fa-solid fa-calendar-day"></i></span> {{ $item->fechaCierre }}
                            </p>
                            <p class="fw-semibold mb-0">
                                <span class="m-1"><i class="fa-solid fa-clock"></i></span> {{ $item->horaCierre }}
                            </p>
                            @endif
                        </td>
                        <td> RD$ {{ number_format($item->saldo_inicial,  2, '.', ',') }}</td>
                        <td> RD$ {{ number_format($item->saldo_final,  2, '.', ',') }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $item->estado == 1 ? 'text-bg-success' : 'text-bg-danger' }}">
                                {{ $item->estado == 1 ? 'aperturada' : 'cerrada' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                @can('ver-movimiento')
                                <form action="{{ route('movimientos.index') }}" method="get">
                                    <input type="hidden" name="caja_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success">ver</button>
                                </form>
                                @endcan


                                @can('cerrar-caja')
                                @if($item->estado == 1)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                    Cerrar
                                </button>
                                @endif
                                @endcan
                            </div>
                        </td>


                        <!-- Modal para confirmar el cierre -->
                        <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que quieres cerrar la caja?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                        <form action="{{ route('cajas.close', $item->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
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

@push('css')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

@if(session('error_permiso'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Uups...',
        text: "{{ session('error_permiso') }}",
        confirmButtonColor: '#d33',
    });
</script>
@endif

@endpush