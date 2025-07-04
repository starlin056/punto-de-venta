<?php

namespace App\Services;

use App\Models\Comprobante;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ComprobanteService
{
    /** Obtener del cache todos los registros de comprobantes */
    public function obtenerComprobantes(): Collection
    {
        return Cache::rememberForever('comprobantes', function () {
            return Comprobante::all();
        });
    }

    /** Limpiar la cache de comprobantes */
    public function limpiarCacheComprobante()
    {
        Cache::forget('comprobantes');
    }
}
