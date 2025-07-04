<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Empleado;
use App\Models\User;
use App\Services\ActivitylogService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Throwable;

class userController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-user|crear-user|editar-user|eliminar-user', ['only' => ['index']]);
        $this->middleware('permission:crear-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'administrador');
        })
            ->latest()
            ->get();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::where('name', '!=', 'administrador')->get();
        $empleados = Empleado::all();
        return view('user.create', compact('roles', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            //Encriptar contraseña
            $fieldHash = Hash::make($request->password);
            //Modificar el valor de password en nuestro request
            $request->merge(['password' => $fieldHash]);

            //Crear usuario
            $user = User::create($request->all());

            //Asignar su rol
            $user->assignRole($request->role);

            DB::commit();
            ActivitylogService::log('Creacion de usuario', 'Usuario', $request->validated());
            return redirect()->route('users.index')->with('success', 'usuario registrado');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Error al crear el usuario", ['error' => $e->getMessage()]);
            return redirect()->route('users.index')->with('error', 'Ups, algo fallo');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        try {
            DB::beginTransaction();

            /*Comprobar el password y aplicar el Hash*/
            if (empty($request->password)) {
                $request = Arr::except($request, array('password'));
            } else {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
            }

            $user->update($request->all());

            /**Actualizar rol */
            $user->syncRoles([$request->role]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('users.index')->with('success', 'Usuario editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $user = User::findOrFail($id);

            // Cambiar el estado del usuario
            $nuevoEstado = $user->estado == 1 ? 0 : 1;
            $user->update(['estado' => $nuevoEstado]);

            // Determinar mensaje según el nuevo estado
            $estadoTexto = $nuevoEstado == 1 ? 'activado' : 'desactivado';
            $mensaje = "Usuario {$estadoTexto} correctamente.";

            // Registrar en bitácora
            ActivitylogService::log("Usuario {$estadoTexto}", 'Usuario', [
                'user_id' => $id,
                'estado' => $nuevoEstado
            ]);

            return redirect()->route('users.index')->with('success', $mensaje);
        } catch (Throwable $e) {
            Log::error('Error al cambiar estado del usuario', [
                'error' => $e->getMessage(),
                'user_id' => $id
            ]);

            return redirect()->route('users.index')->with('error', 'Ups, algo falló al cambiar el estado del usuario.');
        }
    }
}
