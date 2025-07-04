<?php

namespace App\Observers;

use App\Models\Caja;
use App\Models\Comprobante;
use App\Models\venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Enum; 

class VentaObsever
{
    
     /**
     * Handle the caja "creating" event.
     */
    public function creating(venta $venta): void
    {
        $caja = Caja::where('user_id', Auth::id())->where('estado', 1)->first();
        $tipoComprobante = Comprobante::findOrFail($venta->comprobante_id)->nombre;

        $venta->user_id = Auth::id();
        $venta->caja_id = $caja->id;
        $venta->numero_comprobante = $venta->generarNumeroVenta($caja->id, $tipoComprobante);
        $venta->fecha_hora = Carbon::now()->toDateTimeLocalString();
    }

    /**
     * Handle the venta "created" event.
     */
    public function created(venta $venta): void
    {
        //
    }

    /**
     * Handle the venta "updated" event.
     */
    public function updated(venta $venta): void
    {
        //
    }

    /**
     * Handle the venta "deleted" event.
     */
    public function deleted(venta $venta): void
    {
        //
    }

    /**
     * Handle the venta "restored" event.
     */
    public function restored(venta $venta): void
    {
        //
    }

    /**
     * Handle the venta "force deleted" event.
     */
    public function forceDeleted(venta $venta): void
    {
        //
    }
}
