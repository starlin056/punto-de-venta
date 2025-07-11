<?php

namespace App\Jobs;

use App\Models\Venta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\EnviarComprobanteVentaMail;
use App\Notifications\EmailComprobanteVentaEnviado;
use Exception;
use Illuminate\Container\Attributes\Log as AttributesLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EnviarComprobanteVentajob implements ShouldQueue
{
    use Queueable;

    protected $ventaId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $ventaId)
    {
        $this->ventaId = $ventaId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $venta = Venta::with('cliente.persona')->find($this->ventaId);

        if (!$venta) {
            Log::warning("venta no encontrada con ID {$this->ventaId}");
            return;
        }

        $cliente_email = $venta->cliente->persona->email;

        if (filter_var($cliente_email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($cliente_email)
                    ->queue(new EnviarComprobanteVentaMail($venta));

         Notification::send($venta->user, new EmailComprobanteVentaEnviado($venta->cliente));


            } catch (\Exception $e) {
                Log::error("Error al enviar comprobante de venta: " . $e->getMessage());
            }
        } else {
            Log::warning("Correo electrónico inválido para cliente con ID {$venta->cliente->id}");
        }
    }
}
