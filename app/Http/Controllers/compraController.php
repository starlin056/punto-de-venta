<?php

namespace App\Http\Controllers;

use App\Enums\MetodoPagoEnum;
use App\Events\CreateCompraDetalleeEvent;
use App\Events\CreateCompraDetalleEvent;
use App\Http\Requests\StoreCompraRequest;
use App\Models\Compra;
use App\Models\Comprobante;
use App\Models\Empresa;
use Illuminate\Support\Facades\Cache;
use App\Models\Producto;
use App\Models\Proveedore;
use App\Services\ComprobanteService;
use App\Services\EmpresaService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class compraController extends Controller
{
    protected EmpresaService $empresa_service;

    function __construct(EmpresaService $empresaService)
    {
        $this->middleware('permission:ver-compra|crear-compra|mostrar-compra|eliminar-compra', ['only' => ['index']]);
        $this->middleware('permission:crear-compra', ['only' => ['create', 'store']]);
        $this->middleware('permission:mostrar-compra', ['only' => ['show']]);
        $this->middleware('permission:eliminar-compra', ['only' => ['destroy']]);
        $this->middleware('Check_Show_Compra_User', ['only' => ['show']]);
        $this->empresa_service = $empresaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Filtra las compras para que solo se muestren las compras del usuario autenticado
        $compras = Compra::with('comprobante', 'proveedore.persona')
            ->where('user_id', Auth::id())  // Solo las compras del usuario autenticado
            ->latest()
            ->get();

        return view('compra.index', compact('compras'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(ComprobanteService $comprobanteService): View
    {
        //$productos = Producto::where('estado', 1)->get();
        // dd($productos); // Ahora la variable está definida y mostrará los productos.

        $proveedores = Proveedore::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();
        $comprobantes = $comprobanteService->obtenerComprobantes();
        $productos = Producto::where('estado', 1)->get();
        $optionsMetodoPago = MetodoPagoEnum::cases();
        $empresa = $this->empresa_service->obtenerEmpresa();

        return view('compra.create', compact('proveedores', 'comprobantes', 'productos', 'optionsMetodoPago', 'empresa'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request): RedirectResponse

    {
        //dd($request->all());

        DB::beginTransaction();
        try {


            //Llenar tabla compras
            $compra = new Compra();


            $request->merge([
                'user_id' => Auth::id(), // Asegúrate de asignar el user_id
                'comprobante_path' => isset($request->file_comprobante)
                    ? $compra->handleUploadFile($request->file_comprobante)
                    : null
            ]);
            $compra = compra::create($request->all());


            //Llenar tabla compra_producto
            //1.Recuperar los arrays
            $arrayProducto_id = (array) $request->get('arrayidproducto', []);
            $arrayCantidad = (array) $request->get('arraycantidad', []);
            $arrayPrecioCompra = (array) $request->get('arraypreciocompra', []);
            $arrayFechaVencimiento = (array) $request->get('arrayfechavencimiento', []);


            //2.Realizar el llenado
            $siseArray = count($arrayProducto_id);
            $cont = 0;
            while ($cont < $siseArray) {
                $compra->productos()->syncWithoutDetaching([
                    $arrayProducto_id[$cont] => [
                        'cantidad' => $arrayCantidad[$cont],
                        'precio_compra' => $arrayPrecioCompra[$cont],
                        'fecha_vencimiento' => $arrayFechaVencimiento[$cont] ?? null
                    ]
                ]);


                //3.despachar evento de creacion de registro
                CreateCompraDetalleEvent::dispatch(
                    $compra,
                    $arrayProducto_id[$cont],
                    $arrayCantidad[$cont],
                    $arrayPrecioCompra[$cont],
                    $arrayFechaVencimiento[$cont]
                );

                $cont++;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error en transacción: ' . $e->getMessage());
        }



        return redirect()->route('compras.index')->with('success', 'compra exitosa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra): View
    {
        $empresa = $this->empresa_service->obtenerEmpresa();
        return view('compra.show', compact('compra', 'empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Compra::where('id', $id)
            ->update([
                'estado' => 0
            ]);

        return redirect()->route('compras.index')->with('success', 'Compra eliminada');
    }
}
