<?php

namespace App\Observers;

use App\Models\inventario;
use App\Models\kardex;
use App\Models\Producto;

class InventarioObserver
{
    /**
     * Handle the inventario "created" event.
     */
    public function created(inventario $inventario): void
    {
        //cada vez que se crea un producto 
         Producto::where('id', $inventario->producto_id)
           ->update([
                'estado' => 1
              
            ]);
    }

    /**
     * Handle the inventario "updated" event.
     */
public function updated(Inventario $inventario): void
{
  //
}


    public function saved(inventario $inventario): void
    {
        $producto = Producto::findOrfail($inventario->producto_id);
        $kardex = new kardex();

        $producto->update([
                'precio' => $kardex->calcularprecioventa($producto->id)
            ]);
        
    }




    /**
     * Handle the inventario "deleted" event.
     */
    public function deleted(inventario $inventario): void
    {
        //
    }

    /**
     * Handle the inventario "restored" event.
     */
    public function restored(inventario $inventario): void
    {
        //
    }

    /**
     * Handle the inventario "force deleted" event.
     */
    public function forceDeleted(inventario $inventario): void
    {
        //
    }
}
