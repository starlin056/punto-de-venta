<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        $notificaciones = $request->user()->notifications()->latest()->get();
        return view('notificaciones.index', compact('notificaciones'));
    }
}
