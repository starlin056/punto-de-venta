<?php

namespace App\Http\Middleware;

use App\Models\Caja;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckMovimientoCajaUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('caja_id')) { // Solo si tiene caja_id
            $caja = Caja::find($request->caja_id);

            if (!$caja || $caja->user_id != Auth::id()) {
                return redirect()->route('cajas.index')
                    ->with('error_permiso', 'No puedes acceder a esta caja.');
            }
        }

        return $next($request);
    }
}
