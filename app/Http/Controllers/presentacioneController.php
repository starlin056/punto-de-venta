<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdatePresentacioneRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use App\Services\ActivitylogService;
use Exception;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

use function Illuminate\Log\log;

class presentacioneController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-presentacione|crear-presentacione|editar-presentacione|eliminar-presentacione', ['only' => ['index']]);
        $this->middleware('permission:crear-presentacione', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-presentacione', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-presentacione', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentacione.index', compact('presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('presentacione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create(['sigla' => $request->sigla]);
            DB::commit();
            ActivitylogService::log('Creacion de presentacion', 'Presentaciones', $request->validated());

            return redirect()->route('presentaciones.index')->with('success', 'Presentación registrada');
        } catch (Throwable $e) {
            DB::rollBack();


            Log::error("Error al crear la presentacion", ['error' => $e->getMessage()]);
            return redirect()->route('presentaciones.index')->with('error', 'Presentación registrada');
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
    public function edit(Presentacione $presentacione): View
    {
        return view('presentacione.edit', compact('presentacione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacioneRequest $request, Presentacione $presentacione): RedirectResponse
    {

        try {

            $presentacione->caracteristica->update($request->validated());
            $presentacione->update($request->validated());

            ActivitylogService::log('Edicion de presentacion', 'Presentaciones', $request->validated());

            return redirect()->route('presentaciones.index')->with('success', 'Presentación editada');
        } catch (Throwable $e) {

            Log::error("Error al editar la presentacion", ['error' => $e->getMessage()]);

            return redirect()->route('presentaciones.index')->with('error', 'Presentación editada');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $message = '';
        $presentacione = Presentacione::find($id);
        if ($presentacione->caracteristica->estado == 1) {
            Caracteristica::where('id', $presentacione->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Presentación eliminada';
        } else {
            Caracteristica::where('id', $presentacione->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Presentación restaurada';
        }

        return redirect()->route('presentaciones.index')->with('success', $message);
    }
}
