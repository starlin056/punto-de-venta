<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empresa extends Model
{
    protected $guarded = ['id'];

    protected $table = 'empresa';

    /**
     * Relación inversa con la tabla Moneda.
     */
    public function moneda(): BelongsTo
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');  // Especificamos la clave foránea 'moneda_id'
    }
}
