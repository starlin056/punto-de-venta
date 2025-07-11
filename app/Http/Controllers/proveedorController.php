<?php

namespace App\Http\Controllers;

use App\Enums\TipoPersonaEnum;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateProveedoreRequest;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\Proveedore;
use App\Services\ActivitylogService;
use Exception;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;




class proveedorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-proveedore|crear-proveedore|editar-proveedore|eliminar-proveedore', ['only' => ['index']]);
        $this->middleware('permission:crear-proveedore', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-proveedore', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-proveedore', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $proveedores = Proveedore::with('persona.documento')->latest()->get();

        return view('proveedore.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $documentos = Documento::all();
        $optionsTipopersona = TipoPersonaEnum::cases();
        return view('proveedore.create', compact('documentos', 'optionsTipopersona'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->proveedore()->create([]);
            DB::commit();

            ActivitylogService::log('Creacion de proveedor', 'proveedores', $request->validated());

            return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado');

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('error al crear al proveedor', ['error' => $e->getMessage()]);
            return redirect()->route('proveedores.index')->with('error', 'Ups, algo salio mal');
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
    public function edit(Proveedore $proveedore): View
    {
        $proveedore->load('persona.documento');
        $documentos = Documento::all();
        return view('proveedore.edit', compact('proveedore', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedoreRequest $request, Proveedore $proveedore): RedirectResponse
    {
        try {

        $proveedore->persona->update($request->validated());
        ActivitylogService::log('Edicion de proveedor', 'proveedores', $request->validated());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor editado');

        } catch (Throwable $e) {

            Log::error('error al editar al proveedor', ['error' => $e->getMessage()]);


            return redirect()->route('proveedores.index')->with('error', 'Ups, algo salio mal');
        }

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {


        try{
            $persona = persona::findOrfail($id);

            $nuevoEstado = $persona->estado == 1 ? 0: 1;
            $persona->update(['estado' => $nuevoEstado]);
            $message = $nuevoEstado == 1 ? 'proveedoor restaurado' : 'proveedor eliminado';


            ActivitylogService::log($message, 'proveedores',[ 
                'persona_id' => $id,
                'estado' => $nuevoEstado
            ]);

            return redirect()->route('proveedores.index')->with('success', $message);

        }catch(Throwable $e){

            Log::error('error al eliminar/restaurar al proveedor', ['error' => $e->getMessage()]);


            return redirect()->route('proveedores.index')->with('error', 'Ups, algo salio mal');

        }
    }
}
