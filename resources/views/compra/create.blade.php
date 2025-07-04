@extends('layouts.app')

@section('title','Realizar compra')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

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
    <h1 class="mt-4 text-center">Crear Compra</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('compras.index')}}">Compras</a></li>
        <li class="breadcrumb-item active">Crear Compra</li>
    </ol>
</div>

<form action="{{ route('compras.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="container-lg mt-4">
        <div class="row gy-4">


            <!-----Compra---->
            <div class="col-11">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row g-3">
                        <!--Proveedor-->
                        <div class="col-12 mb-2">
                            <label for="proveedore_id" class="form-label">Proveedor:</label>
                            <select name="proveedore_id" id="proveedore_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                @foreach ($proveedores as $item)
                                <option value="{{$item->id}}">{{$item->nombre_documento}}</option>
                                @endforeach
                            </select>
                            @error('proveedore_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Tipo de comprobante-->
                        <div class="col-md-4 mb-2">
                            <label for="comprobante_id" class="form-label">Comprobante:</label>
                            <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker" title="Selecciona">
                                @foreach ($comprobantes as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                            @error('comprobante_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>


                        <!--comprobante comprobante-->
                        <div class="col-md-4 mb-2">
                            <label for="numero_comprobante" class="form-label">Numero de comprobante:</label>
                            <input required type="text" name="numero_comprobante" id="numero_comprobante" class="form-control">
                            @error('numero_comprobante')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>


                        <!--comprobante file pdf-->
                        <div class="col-md-4">
                            <label for="fille_comprobante" class="form-label">Archivo:</label>
                            <input type="file" name="file_comprobante" id="file_comprobante" class="form-control" accept=".pdf">
                            @error('file_comprobante')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Tipo de pagos-->
                        <div class="col-md-6">
                            <label for="metodo_pago" class="form-label">Metodo de pago:</label>
                            <select required name="metodo_pago" id="metodo_pago" class="form-control selectpicker" title="Selecciona">
                                @foreach ($optionsMetodoPago as $item)
                                <option value="{{$item->value}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('metodo_pago')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Impuesto--
                        <div class="col-sm-6 mb-2">
                            <label for="impuesto" class="form-label">Impuesto:</label>
                            <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-success">
                            @error('impuesto')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div> -->

                        <!--Fecha--->
                        <div class="col-sm-6">
                            <label for="fecha_hora" class="form-label">
                                Fecha y hora:</label>
                            <input
                                required
                                type="datetime-local"
                                name="fecha_hora"
                                id="fecha_hora"
                                class="form-control"
                                value="">
                            @error('fecha_hora')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <!-- Detalles de la compra -->
    <div class="container-lg mt-4">
        <div class="row gy-4">
            <div class="col-11">
                <div class="text-white bg-success p-1 text-center">
                    Detalles de la compra
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row g-4">

                        <!-----Producto---->
                        <div class="col-12">
                            <select
                                id="producto_id"
                                class="form-control selectpicker"
                                data-live-search="true"
                                data-size="1"
                                title="Busque un producto aquí">
                                @foreach ($productos as $item)
                                <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-----Cantidad---->
                        <div class="col-sm-4">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" id="cantidad" class="form-control">
                        </div>

                        <!-----Precio de compra---->
                        <div class="col-sm-4">
                            <label for="precio_compra" class="form-label">Precio de Compra:</label>
                            <input type="number" id="precio_compra" class="form-control" step="0.1">
                        </div>

                        <!-----fecha de vencimiento---->
                        <div class="col-sm-4">
                            <label for="fecha_vencimiento" class="form-label">fecha de vencimiento:</label>
                            <input type="date" id="fecha_vencimiento" class="form-control">
                        </div>

                        <!-----botón para agregar--->
                        <div class="col-12 my-4 text-end">
                            <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                        </div>

                        <!-----Tabla para el detalle de la compra--->
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white">Producto</th>
                                            <th class="text-white">Presentacion</th>
                                            <th class="text-white">Cantidad</th>
                                            <th class="text-white">Precio</th>
                                            <th class="text-white">Vencimiento</th>
                                            <th class="text-white">Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">SUMA</th>
                                            <th colspan="2">
                                                <input type="hidden" name="subtotal" value="0" id="inputSubtotal">
                                                <span id="sumas">RD$0.00</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="5">{{$empresa->abreviatura_impuesto}} %</th>
                                            <th colspan="2">
                                                <input type="hidden" name="impuesto" value="0" id="inputImpuesto">
                                                <span id="igv">RD$0.00</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">
                                                <input type="hidden" name="total" value="0" id="inputTotal">
                                                <span id="total">RD$0.00</span>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <!--Botones--->
                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-success" id="guardar">Realizar compra</button>
                        </div>

                        <!--Boton para cancelar compra-->
                        <div class="col-12 mt-2">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar compra
                            </button>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Modal para cancelar la compra -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres cancelar la compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnCancelarCompra" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

</form>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
$(document).ready(function() {
    $('#btn_agregar').click(function() {
        agregarProducto();
    });

    $('#btnCancelarCompra').click(function() {
        cancelarCompra();
    });

    disableButtons();
});

let arrayIdProductos = [];
let subtotal = [];
let sumas = 0;
let igv = 0;
let total = 0;
let impuesto = 18;
let cont = 0;

function formatoRD(valor) {
    return valor.toLocaleString('es-DO', {
        style: 'currency',
        currency: 'DOP'
    });
}

function cancelarCompra() {
    // Limpiar tabla
    $('#tabla_detalle tbody').html('');

    // Reiniciar variables
    cont = 0;
    subtotal = [];
    sumas = 0;
    igv = 0;
    total = 0;
    arrayIdProductos = [];

    // Limpiar campos visuales
    $('#sumas').html(formatoRD(0));
    $('#igv').html(formatoRD(0));
    $('#total').html(formatoRD(0));
    $('#inputSubtotal').val('');
    $('#inputImpuesto').val('');
    $('#inputTotal').val('');

    // Limpiar formulario
    limpiarCampos();

    // Ocultar botones
    disableButtons();
}

function disableButtons() {
    if (total == 0) {
        $('#guardar').hide();
        $('#cancelar').hide();
    } else {
        $('#guardar').show();
        $('#cancelar').show();
    }
}

function agregarProducto() {
    let idProducto = $('#producto_id').val();
    let textProducto = $('#producto_id option:selected').text();

    let matchNombre = textProducto.match(/-\s(.*?)\s-/);
    let nameProducto = matchNombre ? matchNombre[1] : "Nombre no encontrado";

    let matchPresentacion = textProducto.match(/Presentacion:\s(.*)/);
    let presentacionProducto = matchPresentacion ? matchPresentacion[1] : "Sin presentación";

    let cantidad = $('#cantidad').val();
    let precioCompra = $('#precio_compra').val();
    let fechaVencimiento = $('#fecha_vencimiento').val();

    if (nameProducto && cantidad && precioCompra) {
        if (parseInt(cantidad) > 0 && parseFloat(precioCompra) > 0) {
            if (!arrayIdProductos.includes(idProducto)) {

                subtotal[cont] = round(cantidad * precioCompra);
                sumas = round(sumas + subtotal[cont]);
                igv = round(sumas * impuesto / 100);
                total = round(sumas + igv);

                let fila = `
                <tr id="fila${cont}">
                    <td><input type="hidden" name="arrayidproducto[]" value="${idProducto}">${nameProducto}</td>
                    <td>${presentacionProducto}</td>
                    <td><input type="hidden" name="arraycantidad[]" value="${cantidad}">${cantidad}</td>
                    <td><input type="hidden" name="arraypreciocompra[]" value="${precioCompra}">${formatoRD(precioCompra)}</td>
                    <td><input type="hidden" name="arrayfechavencimiento[]" value="${fechaVencimiento}">${fechaVencimiento}</td>
                    <td>${formatoRD(subtotal[cont])}</td>
                    <td><button class="btn btn-danger" type="button" onClick="eliminarProducto(${cont}, '${idProducto}')">
                        <i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>`;

                $('#tabla_detalle tbody').append(fila);

                arrayIdProductos.push(idProducto);
                actualizarTotales();
                limpiarCampos();
                cont++;
            } else {
                showModal("Ya ha ingresado este producto.");
            }
        } else {
            showModal("Valores incorrectos.");
        }
    } else {
        showModal("Le faltan campos por llenar.");
    }
}

function eliminarProducto(indice, idProducto) {
    sumas = round(sumas - subtotal[indice]);
    igv = round(sumas * impuesto / 100);
    total = round(sumas + igv);

    $('#fila' + indice).remove();

    arrayIdProductos = arrayIdProductos.filter(id => id !== idProducto);

    actualizarTotales();
}

function actualizarTotales() {
    $('#sumas').html(formatoRD(sumas));
    $('#igv').html(formatoRD(igv));
    $('#total').html(formatoRD(total));
    $('#inputSubtotal').val(sumas);
    $('#inputImpuesto').val(igv);
    $('#inputTotal').val(total);
    disableButtons();
}

function limpiarCampos() {
    $('#producto_id').val('').change();
    $('#cantidad').val('');
    $('#precio_compra').val('');
    $('#fecha_vencimiento').val('');
}

function round(num, decimales = 2) {
    let signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0) return signo * Math.round(num);

    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}

function showModal(message, icon = 'error') {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}
</script>

@endpush