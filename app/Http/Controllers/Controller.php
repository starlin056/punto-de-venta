<?php

namespace App\Http\Controllers;

// Importa el trait AuthorizesRequests que proporciona métodos para la autorización de usuarios.
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// Importa el trait DispatchesJobs que permite despachar trabajos (jobs) a la cola.
use Illuminate\Foundation\Bus\DispatchesJobs;
// Importa el trait ValidatesRequests que proporciona métodos para la validación de solicitudes.
use Illuminate\Foundation\Validation\ValidatesRequests;
// Importa la clase BaseController de la cual heredará nuestra clase Controller.
use Illuminate\Routing\Controller as BaseController;

// Define la clase Controller que extiende de BaseController.
class Controller extends BaseController
{
    // Usa los traits AuthorizesRequests, DispatchesJobs y ValidatesRequests en esta clase.
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}