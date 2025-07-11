<?php

namespace App\Models;

use App\Observers\InventarioObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([InventarioObserver::class])]
class Inventario extends Model
{
    protected $guarded = ['id'];
    protected $table = 'inventario';

    // Relación con Producto
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Relación con Ubicación
    public function ubicacione(): BelongsTo
    {
        return $this->belongsTo(Ubicacione::class, 'ubicacione_id');
    }
}
