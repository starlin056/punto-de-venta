<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleadoRequest;
use App\Models\Empleado;
use Illuminate\Support\Facades\Storage;
use App\Services\ActivitylogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\Log;
use Throwable;

class EmpleadoController extends Controller
{
    public function index(): View
    {
        $empleados = Empleado::latest()->get();
        return view('empleado.index', compact('empleados'));
    }

    public function create(): View
    {
        return view('empleado.create');
    }

    public function store(StoreEmpleadoRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Si viene archivo, lo subimos y guardamos sólo la ruta
            if ($request->hasFile('img')) {
                $data['img'] = (new Empleado)
                    ->handleUploadImage($request->file('img'));
            }

            Empleado::create($data);

            ActivitylogService::log('Creacion de Empleado', 'Empleado', $request->validated());
            return redirect()->route('empleados.index')->with('success', 'Empleado registrado');
        } catch (Throwable $e) {
            Log::error('Error al crear el empleado', ['error' => $e->getMessage()]);
            return back()->with('error', 'Ups, algo falló');
        }
    }

    public function edit(Empleado $empleado): View
    {
        return view('empleado.edit', compact('empleado'));
    }

    public function update(StoreEmpleadoRequest $request, Empleado $empleado): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('img')) {
                $data['img'] = $empleado->handleUploadImage(
                    $request->file('img'),
                    $empleado->img
                );
            }

            $empleado->update($data);
            ActivitylogService::log('actualizacion del Empleado', 'Empleado', $request->validated());
            return redirect()->route('empleados.index')->with('success', 'Empleado actualizado');
        } catch (Throwable $e) {
            Log::error('Error al actualizar el empleado', ['message' => $e->getMessage()]);
            return back()->with('error', 'Ups, algo salió mal');
        }
    }

    public function destroy(Empleado $empleado): RedirectResponse
    {
        try {
            // 1. Prepara los datos para el log
            $logData = [
                'id'           => $empleado->id,
                'razon_social' => $empleado->razon_social,
                'cargo'        => $empleado->cargo,
            ];

            // 2. Borra la imagen del disco si existe
            if ($empleado->img && \Storage::disk('public')->exists($empleado->img)) {
                \Storage::disk('public')->delete($empleado->img);
            }

            // 3. Elimina el registro
            $empleado->delete();

            // 4. Registra la eliminación en el log de actividad
            ActivitylogService::log(
                'Eliminación de empleado', // Acción
                'Empleados',               // Módulo
                $logData                   // Datos relevantes
            );

            return redirect()
                ->route('empleados.index')
                ->with('success', 'Empleado eliminado');
        } catch (Throwable $e) {
            Log::error('Error al eliminar el empleado', [
                'message' => $e->getMessage()
            ]);
            return back()->with('error', 'Ups, algo salió mal');
        }
    }
}
