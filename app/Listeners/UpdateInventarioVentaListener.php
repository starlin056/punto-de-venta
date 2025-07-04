<?php

namespace App\Listeners;

use App\Events\CreateVentaDetalleEvent;
use App\Models\Inventario;

class UpdateInventarioVentaListener
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
        // 1) Obtener el registro de inventario para el producto vendido
        $registro = Inventario::where('producto_id', $event->producto_id)->first();

        // Si no existe dicho registro, salimos para no generar error
        if (! $registro) {
            return;
        }

        // 2) Calcular nueva cantidad y actualizar
        $nuevaCantidad = $registro->cantidad - $event->cantidad;
        $registro->update([
            'cantidad' => $nuevaCantidad,
        ]);
    }
}
