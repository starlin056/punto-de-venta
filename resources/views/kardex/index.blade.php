@extends('layouts.app')

@section('title','kardex')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@push('css')
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
    <h1 class="mt-4 text-center">Kardex</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href=" route('panel') " content="Inicio" />
        <x-breadcrumb.item active='true' content="Kardex" />
    </x-breadcrumb.template>
    <!--buscar y label -->
    <div class="mb-3">
        <form action="{{route('kardex.index')}}" method="get">
            <div class="row align-items-center">
                <label for="producto_id" class="col-sm-2 col-form-label">Producto</label>
                <div class="col-sm-7">
                    
                    <select name="producto_id" id="producto_id"
                        class="form-control selectpicker"
                        data-live-search='true' data-zize='3' title='Busque un producto aqui'>
                        @foreach ($productos as $item)
                        <option value="{{$item->id}}" {{$item->id == $producto_id ? 'selected': ''}}>
                            {{$item->nombre_completo}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if ($kardex->count())
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Kardex del Producto
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table-striped fs-6">
                <thead>
                    <tr>
                        <th>Fecha y Hora</th>
                        <th>Transacción</th>
                        <th>Descripción</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Saldo</th>
                        <th>Costo Unitario</th>
                        <th>Costo Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kardex as $item)
                    <tr>
                        <td>
                            {{$item->fecha}} - {{$item->hora}}
                        </td>
                        <td>
                            {{$item->tipo_transaccion}}
                        </td>
                        <td>
                            {{$item->descripcion_transaccion}}
                        </td>
                        <td>
                            {{$item->entrada}}
                        </td>
                        <td>
                            {{$item->salida}}
                        </td>
                        <td>
                            {{$item->saldo}}
                        </td>
                        <td>
                           RD$ {{ number_format($item->costo_unitario, 2, '.', ',') }}

                        </td>
                        <td>
                            <!-- Cálculo del costo total con formato adecuado -->
                            RD$ {{ number_format(($item->saldo * $item->costo_unitario), 2, '.', ',') }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <p class="text-center my-5">!! Sin Inventario !!</p>
    @endif



</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush