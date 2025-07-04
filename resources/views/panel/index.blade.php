@extends('layouts.app')

@section('title','Panel')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')


@push('css')
<style>
    body {
        background-color: rgba(255, 255, 255, 0.82);
        /* Color más oscuro */

    }

    /**.card {
        background-color: #444 !important;
        color: white;
    } */
</style>
@endpush

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
    <h1 class="mt-4">Panel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Panel</li>
    </ol>
    <div class="row">
        <!----Clientes--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgba(86, 81, 81, 0.94);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-people-group"></i><span class="m-1">Clientes</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Cliente;

                            $clientes = count(Cliente::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$clientes}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('clientes.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Categoria--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(11, 164, 230);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-tag"></i><span class="m-1">Categorías</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Categoria;

                            $categorias = count(Categoria::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$categorias}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('categorias.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Compra--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(11, 223, 230);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-store"></i><span class="m-1">Compras</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Compra;

                            $compras = count(Compra::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$compras}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('compras.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Marcas--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(183, 11, 230);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-bullhorn"></i><span class="m-1">Marcas</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Marca;

                            $marcas = count(Marca::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$marcas}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('marcas.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Presentaciones--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(230, 11, 11);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-box-archive"></i><span class="m-1">Presentaciones</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Presentacione;

                            $presentaciones = count(Presentacione::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$presentaciones}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('presentaciones.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Producto--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(230, 172, 11);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-brands fa-shopify"></i><span class="m-1">Productos</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Producto;

                            $productos = count(Producto::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$productos}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('productos.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Proveedore--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(133, 39, 54);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-user-group"></i><span class="m-1">Proveedores</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Proveedore;

                            $proveedores = count(Proveedore::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$proveedores}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('proveedores.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Users--->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgba(189, 91, 0, 0.87);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-user"></i><span class="m-1">Usuarios</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\User;

                            $users = count(User::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$users}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('users.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>


    <!-- grafico cantidaad stock -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chat-bar me-1"></i>
                    3 Productos con el stock mas bajo
                </div>
                <div class="card-body"><canvas id="productosChart" width="100%" height="30" style="margin-top: auto;"></canvas></div>
            </div>
        </div>
    </div>
    <!-- grafico ventas -->
    <!-- <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chat-area me-1"></i>
                    Ventas en los ultimos 7 dias
                </div>
                <div class="card-body"><canvas id="ventasChart" width="100%" height="45"></canvas></div>
            </div>
        </div>
    </div> -->


    @if (auth()->user()->hasRole('administrador') || count($totalventasPorDia) > 0)
    <!-- Gráfico de ventas -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-line me-1"></i>
                    {{ auth()->user()->hasRole('administrador') ? 'Ventas en los últimos 7 días (Todos los usuarios)' : 'Mis ventas del día' }}
                </div>
                <div class="card-body">
                    <canvas id="ventasChart" width="100%" height="45"></canvas>
                </div>
            </div>
        </div>
    </div>
    @elseif (!auth()->user()->hasRole('administrador'))
    <div class="alert alert-info text-center">
        No tienes ventas registradas hoy.
    </div>
    @endif





</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

<script>
    // -------------------- Gráfico de Ventas por Día --------------------
    const datosVentas = @json($totalventasPorDia);

    const fechas = datosVentas.map(venta => {
        const [year, month, day] = venta.fecha.split('-');
        return `${day}/${month}/${year}`;
    });

    const montos = datosVentas.map(venta => parseFloat(venta.total));

    const ctxVentas = document.getElementById('ventasChart').getContext('2d');

    // Degradado para fondo
    const gradiente = ctxVentas.createLinearGradient(0, 0, 0, 400);
    gradiente.addColorStop(0, 'rgba(2, 117, 216, 0.5)');
    gradiente.addColorStop(1, 'rgba(2, 117, 216, 0)');

    new Chart(ctxVentas, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: 'Ventas por Día',
                data: montos,
                fill: true,
                tension: 0.4,
                backgroundColor: gradiente,
                borderColor: '#0275d8',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#0275d8',
                pointHoverRadius: 6,
                pointHoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: {
                            family: 'Segoe UI',
                            size: 13
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#f8f9fa',
                    titleColor: '#0275d8',
                    bodyColor: '#000',
                    borderColor: '#0275d8',
                    borderWidth: 1,
                    callbacks: {
                        label: (context) => `RD$ ${context.formattedValue}`
                    }
                },
                title: {
                    display: true,
                    text: 'Histórico de Ventas',
                    font: {
                        size: 18,
                        weight: 'bold'
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Fecha',
                        font: {
                            size: 14
                        }
                    },
                    ticks: {
                        color: '#555'
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Monto (RD$)',
                        font: {
                            size: 14
                        }
                    },
                    ticks: {
                        color: '#555',
                        callback: value => `RD$ ${value}`
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    });

    // -------------------- Gráfico de Productos con Bajo Stock --------------------
    const datosProductos = @json($productosStockBajo);

    const nombres = datosProductos.map(p => p.nombre);
    const stocks = datosProductos.map(p => parseInt(p.cantidad));

    const colores = stocks.map(cantidad => {
        if (cantidad < 13) {
            return 'rgba(255, 99, 132, 0.7)'; // rojo
        } else if (cantidad <= 13) {
            return 'rgba(255, 206, 86, 0.7)'; // amarillo
        } else {
            return 'rgba(2, 117, 216, 0.6)'; // azul
        }
    });

    const ctxProductos = document.getElementById('productosChart').getContext('2d');

    new Chart(ctxProductos, {
        type: 'bar',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Stock Disponible',
                data: stocks,
                backgroundColor: colores,
                borderColor: '#fff',
                borderWidth: 2,
                hoverBorderColor: '#ccc',
                borderRadius: 6,
                barThickness: 20
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: context => `Stock: ${context.raw}`
                    }
                },
                title: {
                    display: true,
                    text: 'Productos con Bajo Stock',
                    font: {
                        size: 18,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 20
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Productos'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

@endpush