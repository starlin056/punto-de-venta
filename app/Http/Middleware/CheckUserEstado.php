<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserEstado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = User::where('email', $request->input('email'))->first();

        if ($user && $user->estado != 1) {
            return redirect()->route('login.login')->withErrors('Usuario no activo');
        }



        return $next($request);
    }
}
