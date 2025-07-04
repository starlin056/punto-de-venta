<?php

namespace App\Http\Controllers;

use App\Enums\MetodoPagoEnum;
use App\Http\Requests\StoreMovimientoRequest;
use App\Models\Caja;
use App\Models\Movimiento;
use App\Services\ActivitylogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class MovimientoController extends Controller
{
    function __construct()
    {
        $this->middleware('check_movimiento_caja_user', ['only' => ['index', 'create', 'store']]);
    }

    public function index(Request $request): View
    {
        //$caja = Caja::findOrfail($request->caja_id);
        //return view('movimiento.index', compact('caja'));


        $caja = Caja::findOrfail($request->caja_id);
        $movimientos = Movimiento::where('caja_id', $request->caja_id)
            ->whereIn('tipo', ['VENTA', 'RETIRO'])
            ->latest()
            ->get();

        return view('movimiento.index', compact('caja', 'movimientos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $caja_id = $request->get('caja_id');
        $optionsMetodoPago = MetodoPagoEnum::cases();
        return view('movimiento.create', compact('optionsMetodoPago', 'caja_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovimientoRequest $request): RedirectResponse
    {
        try {

            Movimiento::create($request->validated());
            ActivitylogService::log('Creacion de movimiento', 'Movimientos', $request->validated());
            return redirect()->route('movimientos.index', ['caja_id' => $request->caja_id])
                ->with('success', 'retiro registrado');
        } catch (Throwable $e) {

            Log::error("Error al crear el movimiento", ['error' => $e->getMessage()]);
            return redirect()->route('movimientos.index', ['caja_id' => $request->caja_id])
                ->with('error', 'Ups, algo fallo');
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
