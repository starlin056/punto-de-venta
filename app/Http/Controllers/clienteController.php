<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Persona;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse as HttpRedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Services\ActivitylogService;

class clienteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|eliminar-cliente', ['only' => ['index']]);
        $this->middleware('permission:crear-cliente', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-cliente', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-cliente', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clientes = Cliente::with('persona.documento')->get();

        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $documentos = Documento::all();
        //dd($documentos);
        return view('cliente.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request): HttpRedirectResponse
    {
       // dd($request->all());
        try {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->cliente()->create([]);
            DB::commit();

            ActivitylogService::log('Creacion de cliente', 'cliente', $request->validated());
            return redirect()->route('clientes.index')->with('success', 'cliente registrado');

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('error al crear al proveedor', ['error' => $e->getMessage()]);
            return redirect()->route('clientes.index')->with('error', 'Ups, algo salio mal');
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
    public function edit(Cliente $cliente): View
    {
        $cliente->load('persona.documento');
        $documentos = Documento::all();
        return view('cliente.edit', compact('cliente', 'documentos'));
        
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
{
    try {
        DB::beginTransaction();
        $cliente->persona->update($request->validated());
        ActivitylogService::log('Edición de cliente', 'cliente', $request->validated());
        DB::commit();
        return redirect()->route('clientes.index')->with('success', 'Cliente editado');
    } catch (Throwable $e) {
        DB::rollBack();
        Log::error('Error al editar cliente', ['error' => $e->getMessage()]);
        return redirect()->route('clientes.index')->with('error', 'Ups, algo salió mal');
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
            $message = $nuevoEstado == 1 ? 'cliente restaurado' : 'cliente eliminado';


            ActivitylogService::log($message, 'cliente',[ 
                'persona_id' => $id,
                'estado' => $nuevoEstado
            ]);

            return redirect()->route('clientes.index')->with('success', $message);

        }catch(Throwable $e){

            Log::error('error al eliminar/restaurar al cliente', ['error' => $e->getMessage()]);


            return redirect()->route('clientes.index')->with('error', 'Ups, algo salio mal');

        }
    
    }
}



