@extends('layouts.app')

@section('title','Realizar venta')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Realizar Venta</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ventas.index')}}">Ventas</a></li>
        <li class="breadcrumb-item active">Realizar Venta</li>
    </ol>
</div>

<form action="{{ route('ventas.store') }}" method="post">
    @csrf
    <div class="container-lg mt-4">
        <div class="row gy-4">


            <!-----Venta---->
            <div class="col-12">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row g-4">
                        <!--Cliente-->
                        <div class="col-12">
                            <label for="cliente_id" class="form-label">Cliente:</label>
                            <select name="cliente_id" id="cliente_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                @foreach ($clientes as $item)
                                <option value="{{$item->id}}">{{$item->nombre_documento}}</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Tipo de comprobante-->
                        <div class="col-md-6">
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
                        <!--metodo de pago-->

                        <div class="col-md-6">
                            <label for="metodo_pago" class="form-label">
                                Metodo de pago:</label>
                            <select require name="metodo_pago"
                                id="metodo_pago"
                                class="form-control selectpicker"
                                title="Selecciona">
                                @foreach ($optionsMetodoPago as $item)
                                <option value="{{$item->value}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('metodo_pago')
                            <small class="text-danger">{{ '*' .$message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <!------venta producto---->
            <div class="col-12">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la venta
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row gy-4">

                        <!-----Producto---->
                        <div class="col-12">
                            <select
                                id="producto_id"
                                class="form-control selectpicker"
                                data-live-search="true"
                                data-size="1"
                                title="Busque un producto aquí">
                                @foreach ($productos as $item)
                                <option value="{{$item->id}}-{{$item->cantidad}}-{{$item->precio}}-{{$item->nombre}}-{{$item->sigla}}">
                                    {{ 'codigo: ' . $item->codigo . ' - ' . $item->nombre . ' - ' . $item->sigla }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <!-----cantidad--->
                        <div class="d-flex justify-content-end">
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <label for="stock" class="col-form-label col-4">En stock:</label>
                                    <div class="col-8">
                                        <input disabled id="stock" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-----precio--->
                        <div class="d-flex justify-content-end">
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <label
                                        for="precio"
                                        class="col-form-label col-4">Precio:</label>
                                    <div class="col-8">
                                        <input disabled id="precio" type="number" class="form-control"
                                            step="any">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-----Cantidad---->
                        <div class="col-md-6">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" id="cantidad" class="form-control">
                        </div>

                        <!-----botón para agregar--->
                        <div class="col-12 text-end">
                            <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                        </div>

                        <!-----Tabla para el detalle de la venta--->
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white">Producto</th>
                                            <th class="text-white">Presentacion</th>
                                            <th class="text-white">Cantidad</th>
                                            <th class="text-white">Precio</th>
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
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Sumas</th>
                                            <th colspan="2">
                                                <input type="hidden" name="subtotal" value="0" id="inputSubtotal">
                                                 <span id="sumas">0.00</span>
                                               
                                            </th>

                                        </tr>
                                        <tr>

                                            <th colspan="4">{{$empresa->abreviatura_impuesto}} ({{$empresa->porcentaje_impuesto}})%</th>
                                            <th colspan="2">
                                                <input type="hidden" name="impuesto" id="inputimpuesto" value="0">
                                                <span id="igv">0.00</span>
                                                
                                               
                                            </th>
                                        </tr>
                                        <tr>

                                            <th colspan="4">Total</th>
                                            <th colspan="2">
                                                <input type="hidden" name="total" value="0" id="inputTotal">
                                                <span id="total">0.00</span>
                                               
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!--Boton para cancelar venta--->
                        <div class="col-12">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar venta
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- finalizar ventas primary es el color de la plantilla-->
            <div class="col-12">
                <div class="text-white bg-primary p-1 text-center">
                    Finalizar venta
                </div>

                <div class="p-3 border border-3 border-primary">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <label for="dinero_recibido" class="form-label">Ingrese dinero recibido: </label>
                            <input type="number" id="dinero_recibido" name="monto_recibido" class="form-control" step="any">
                        </div>

                        <div class="col-md-6">
                            <label for="vuelto" class="form-label">Devolver: </label>
                            <input readonly type="number" name="vuelto_entregado" id="vuelto" class="form-control" step="any">
                        </div>

                        <!--Botones--->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success" id="guardar">Realizar venta</button>
                        </div>
                    </div>
                </div>



            </div>


        </div>
    </div>

    <!-- Modal para cancelar la venta -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres cancelar la venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelarVenta" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
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

        $('#producto_id').change(mostrarValores);


        $('#btn_agregar').click(function() {
            agregarProducto();
        });

        $('#btnCancelarVenta').click(function() {
            cancelarVenta();
        });

        disableButtons();

        $('#dinero_recibido').on('input', function() {
            let dineroRecibido = parseFloat($(this).val());
            let totalVenta = parseFloat($('#inputTotal').val());

            if (!isNaN(dineroRecibido) && !isNaN(totalVenta) && dineroRecibido >= totalVenta && totalVenta > 0) {
                let vuelto = dineroRecibido - totalVenta;
                $('#vuelto').val(vuelto.toFixed(2));
            } else {
                $('#vuelto').val('');
            }
        });




    });

    //Variables
    let cont = 0;
    let subtotal = [];
    let sumas = 0;
    let igv = 0;
    let total = 0;
    let arrayIdProductos = [];

    function formatoRD(valor) {
    return valor.toLocaleString('es-DO', {
        style: 'currency',
        currency: 'DOP'
    });
}


    //Constantes
    const impuesto = @json($empresa->porcentaje_impuesto);

    function mostrarValores() {
        let dataProducto = document.getElementById('producto_id').value.split('-');
        $('#stock').val(dataProducto[1]);
        $('#precio').val(dataProducto[2]);
    }

    function agregarProducto() {
        let dataProducto = document.getElementById('producto_id').value.split('-');

        // Obtener valores de los campos
        let idProducto = dataProducto[0];
        let nameProducto = dataProducto[3];
        let presentacioneProducto = dataProducto[4];
        let cantidad = $('#cantidad').val();
        let precioVenta = $('#precio').val();
        let stock = $('#stock').val();

        // Validaciones
        if (!idProducto || !cantidad) {
            showModal('Le faltan campos por llenar');
            return;
        }

        if (parseInt(cantidad) <= 0 || (cantidad % 1 !== 0)) {
            showModal('Valores incorrectos');
            return;
        }

        if (parseInt(cantidad) > parseInt(stock)) {
            showModal('La Cantidad no esta en inventario');
            return;
        }

        // Validar si el producto ya fue agregado
        if (arrayIdProductos.includes(idProducto)) {
            showModal('Ya ha ingresado el producto');
            return;
        }

        // Calcular valores
        subtotal[cont] = round(cantidad * precioVenta);
        sumas = round(subtotal.reduce((a, b) => a + b, 0)); // suma todos los subtotales
        igv = round(sumas / 100 * impuesto);
        total = round(sumas + igv);

        // Crear la fila
        let fila = `<tr id="fila${cont}">
        <td><input type="hidden" name="arrayidproducto[]" value="${idProducto}">${nameProducto}</td>
        <td>${presentacioneProducto}</td>
        <td><input type="hidden" name="arraycantidad[]" value="${cantidad}">${cantidad}</td>
        <td><input type="hidden" name="arrayprecioventa[]" value="${precioVenta}">${precioVenta}</td>
        <td>${subtotal[cont]}</td>
        <td><button class="btn btn-danger" type="button" onClick="eliminarProducto(${cont},${idProducto})"><i class="fa-solid fa-trash"></i></button></td>
    </tr>`;

        // Agregar fila a la tabla
        $('#tabla_detalle').append(fila);

        // Actualizar contadores y campos
        limpiarCampos();
        cont++;
        disableButtons();

        $('#sumas').html(formatoRD(sumas));
        $('#igv').html(formatoRD(igv));
        $('#total').html(formatoRD(total));

         $('#inputimpuesto').val(igv);
         $('#inputTotal').val(total);
         $('#inputSubtotal').val(sumas);

        // Agregar idProducto al arreglo para evitar duplicados
        arrayIdProductos.push(idProducto);
    }


    function eliminarProducto(indice, idProducto) {
        //Calcular valores
        sumas -= round(subtotal[indice]);
        igv = round(sumas / 100 * impuesto);
        total = round(sumas + igv);

        //Mostrar los campos calculados
        $('#sumas').html(formatoRD(sumas));
        $('#igv').html(formatoRD(igv));
        $('#total').html(formatoRD(total));
        $('#inputimpuesto').val(igv);
        $('#inputTotal').val(total);
        $('#inputSubtotal').val(sumas);


        //Eliminar el fila de la tabla
        $('#fila' + indice).remove();
        // elimina el id del arreglo
        let index = arrayIdProductos.indexOf(idproducto.toString());
        arrayIdProductos.splice(index, 1);

        disableButtons();
    }

    function cancelarVenta() {
        //Elimar el tbody de la tabla
        $('#tabla_detalle tbody').empty();

        //Añadir una nueva fila a la tabla
        let fila = '<tr>' +
            '<th></th>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '</tr>';
        $('#tabla_detalle').append(fila);

        //Reiniciar valores de las variables
        //Variables
        cont = 0;
        subtotal = [];
        sumas = 0;
        igv = 0;
        total = 0;
        arrayIdProductos = [];

        //Mostrar los campos calculados
       $('#sumas').html(formatoRD(sumas));
        $('#igv').html(formatoRD(igv));
        $('#total').html(formatoRD(total));
        $('#inputimpuesto').val(igv);
        $('#inputTotal').val(total);
        $('#inputSubtotal').val(sumas);

        limpiarCampos();
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

    function limpiarCampos() {
        let select = $('#producto_id');
        select.selectpicker('val', '');
        $('#cantidad').val('');
        $('#precio').val('');
        $('#descuento').val('');
        $('#stock').val('');
    }

    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }
    //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
</script>
@endpush