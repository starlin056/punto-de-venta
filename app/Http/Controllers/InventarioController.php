<?php

namespace App\Http\Controllers;

use App\Enums\TipoTransaccionEnum;
use App\Http\Requests\StoreInventarioRequest;
use App\Models\Inventario;
use App\Models\kardex;
use App\Models\Producto;
use App\Models\ubicacione;
use App\Services\ActivitylogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;




class InventarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('check_producto_inicializado', ['only' => ['create', 'store']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $inventario = Inventario::latest()->get();

        return view('inventario.index', compact('inventario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $producto = Producto::findOrfail($request->producto_id);
        $ubicaciones = ubicacione::all();
        return view('inventario.create', compact('producto', 'ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventarioRequest $request, kardex $kardex): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $kardex->crearRegistro($request->validated(), TipoTransaccionEnum::Apertura);
            Inventario::create($request->validated());
            DB::commit();
            ActivitylogService::log('Inicializacion de producto', 'producto', $request->validated());
            return redirect()->route('productos.index')->with('success', 'Producto inicializado.');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error al inicializar el producto", ['error' => $e->getMessage()]);
            return redirect()->route('productos.index')->with('error', 'Algo falló al inicializar el producto.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
