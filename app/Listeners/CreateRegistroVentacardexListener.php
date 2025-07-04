<?php

namespace App\Listeners;

use App\Enums\TipoTransaccionEnum;
use App\Events\CreateVentaDetalleEvent;
use App\Models\Kardex;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRegistroVentacardexListener
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
    public function handle(CreateVentaDetalleEvent $event): void
    {
        // crear un nuevo registro en la tabla kardex, de tipo venta
        $kardex = new Kardex();

        // obtener el costo unitario del último registro para este producto
        $ultimoRegistro = $kardex
            ->where('producto_id', $event->producto_id ?? $event->producto_id)
            ->latest('id')
            ->first();

        $costoUnitario = $ultimoRegistro?->costo_unitario ?? 0;

        // crear registro en kardex con datos de la venta
        $kardex->crearRegistro(
            [
                'venta_id'       => $event->venta->id,
                'producto_id'    => $event->producto_id ?? $event->producto_id,
                'cantidad'       => $event->cantidad,
                'costo_unitario' => $costoUnitario,
            ],
            TipoTransaccionEnum::venta
        );
    }
}
