<?php

namespace App\Listeners;

use App\Events\CreateVentaEvent;
use App\Jobs\EnviarComprobanteVentajob;

class EnviarEmailClienteVentaListener
{
    /**
     * Maneja el evento para enviar el comprobante por correo.
     */
    public function handle(CreateVentaEvent $event): void
    {
        EnviarComprobanteVentajob::dispatch($event->venta->id)->afterCommit();
    }
}
