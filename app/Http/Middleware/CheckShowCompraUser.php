<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckShowCompraUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $compra = $request->route('compra'); // Obtiene la compra desde la ruta

        // Verifica que la compra pertenece al usuario autenticado
        if ($compra->user_id != Auth::id()) {
            return redirect()->route('compras.index')  // Redirige al listado si no pertenece
                ->with('error', 'No es posible acceder a esta compra.');
        }

        return $next($request);
    }
}
