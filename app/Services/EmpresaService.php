<?php

namespace App\Services;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;


class EmpresaService
{
    /** Obtener del cache todos los registros de empresa */
    public function obtenerEmpresa(): empresa
    {
        return Cache::remember('empresa', 3600, function () {
            return Empresa::first(); 
        });
    }

    /** Limpiar la cache de empresa */
    public function limpiarCacheEmpresa()
    {
        Cache::forget('empresa');
    }
}
