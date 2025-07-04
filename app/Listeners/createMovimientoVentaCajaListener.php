<?php

namespace App\Listeners;

use App\Enums\TipoMovimientoEnum;
use App\Events\CreateVentaEvent;
use App\Models\Caja;
use App\Models\Movimiento;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class createMovimientoVentaCajaListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateVentaEvent $event): void
    {
        //
        $caja_id = Caja::where('user_id', Auth::id())->where('estado', 1)->first()->id;

        try {
            Movimiento::create([
                'tipo' => TipoMovimientoEnum::Venta,
                'descripcion' => 'venta # ' . $event->venta->numero_comprobante,
                'monto' => $event->venta->total,
                'metodo_pago' => $event->venta->metodo_pago,
                'caja_id' => $caja_id
            ]);
        } catch (Exception $e) {
            Log::error(
                "Error en el Listener CreateMovimientoVentaCajaListener",
                ['error' => $e->getMessage()]
            );
        }
    }
}
