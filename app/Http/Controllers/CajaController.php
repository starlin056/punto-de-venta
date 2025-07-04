<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Rules\CajaCerradaRule;
use App\Services\ActivitylogService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Throwable;


class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cajas = Caja::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('caja.index', compact('cajas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('caja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'saldo_inicial' => ['required', 'numeric', 'min:1', new CajaCerradaRule]
        ]);
        try {
            $caja = Caja::create($request->all());
            ActivitylogService::log('Creacion de caja', 'Cajas', ['caja' => $caja]);
            return redirect()->route('cajas.index')->with('success', 'Caja aperturada');
        } catch (Throwable $e) {
            Log::error('Error al crear la caja', ['error' => $e->getMessage()]);
            return redirect()->route('cajas.index')->with('error', 'Ups, algo fallo');
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
    public function destroy(string $id) {}

    public function close(Request $request, $id)
    {
        $caja = Caja::findOrFail($id);
        $caja->estado = 0; // Cambia el estado a 'cerrada'
        $caja->save(); // Esto activará la lógica del Observer automáticamente

        return redirect()->route('cajas.index')->with('success', 'Caja cerrada con éxito.');
    }
}
