<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedore extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id'];
    /**  Relación muchos a uno con el modelo Persona */

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
    /**    Relación uno a muchos con el modelo Compra */
    
    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }

    public function getNombreDocumentoAttribute(): string
    {
        return $this->persona->razon_social . '_' . $this->persona->documento->nombre . ': ' . $this->persona->numero_documento;
    }
    
}
