<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Moneda extends Model
{
    // Especificamos el nombre correcto de la tabla
    protected $table = 'moneda';

    public function empresa(): HasOne
    {
        return $this->hasOne(Empresa::class, 'moneda_id');  // Especificamos la clave foránea si es diferente
    }
}
