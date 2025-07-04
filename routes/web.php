<?php

use App\Http\Controllers\ActivitylogController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\ExportPDFcontroller;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ventaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificacionController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el grupo de middleware "web". 
|
*/

Route::get('/', [homeController::class, 'index'])->name('panel');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::resource('categorias', categoriaController::class)->except('show');
    Route::resource('presentaciones', presentacioneController::class)->except('show');
    Route::resource('marcas', marcaController::class)->except('show');
    Route::resource('productos', ProductoController::class)->except('show', 'destroy');
    Route::resource('clientes', clienteController::class)->except('show');
    Route::resource('proveedores', proveedorController::class)->except('show');
    Route::resource('compras', compraController::class)->except('edit', 'update', 'destroy');
    Route::resource('ventas', ventaController::class)->except('edit', 'update');
    Route::resource('users', userController::class)->except('show');
    Route::resource('roles', roleController::class)->except('show');
    Route::resource('profile', profileController::class)->only('index', 'update');
    Route::resource('Activitylog', ActivitylogController::class)->only('index');
    Route::resource('inventario', InventarioController::class)->only('index', 'create', 'store');
    Route::resource('kardex', KardexController::class)->only('index');
    Route::resource('empresa', EmpresaController::class)->only('index', 'update');
    Route::resource('empleados', EmpleadoController::class)->except('show');
    Route::resource('cajas', CajaController::class)->except('edit', 'update', 'show');
    Route::post('/cajas/{id}/close', [CajaController::class, 'close'])->name('cajas.close');
    Route::resource('movimientos', MovimientoController::class)->except('show', 'edit', 'update', 'destroy');


    //reporte pdf
    Route::get('/export-pdf-comprobante-venta/{id}', [ExportPDFcontroller::class, 'exportPDFComprobanteVenta'])
        ->name('export.pdf-comprobante-venta');
    //reporte Excel
    Route::get('/export-excel-ventas-all', [ExportExcelController::class, 'exportExcelVentasAll'])
        ->name('export.excel-ventas-all');

    Route::post('/import-excel-empleados', [ImportExcelController::class, 'importExcelEmpleados'])
        ->name('import.excel-empleados');

    Route::middleware('auth')->post('/notifications/mark-as-read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.markAsRead');


    Route::get('/notificaciones', [NotificacionController::class, 'index'])
        ->name('notificaciones.index')
        ->middleware('auth');




    Route::get('/logout', [logoutController::class, 'logout'])->name('logout');
});

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login.login');


Route::get('/401', function () {
    return view('errors.401');
});
Route::get('/404', function () {
    return view('errors.404');
});
Route::get('/500', function () {
    return view('errors.500');
});
