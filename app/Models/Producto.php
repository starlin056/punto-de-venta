<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
 
    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class)
        ->withTimestamps()
        ->withPivot('cantidad', 'precio_compra', 'fecha_vencimiento');
    }

    public function ventas(): BelongsToMany
    {
        return $this->belongsToMany(Venta::class)
        ->withTimestamps()
        ->withPivot('cantidad', 'precio_venta');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }


    public function presentacione(): BelongsTo
    {
        return $this->belongsTo(Presentacione::class);
    }


    public function inventario(): HasOne
    {
        return $this->hasOne(inventario::class);
    }

    public function kardex(): HasMany
    {
        return $this->hasMany(kardex::class);
    }


    protected static function booted()
    {
        static::creating(function($producto){
            //si no se proporciona un  codigo, generar uno unico
            if(empty($producto->codigo)){
                $producto->codigo = self::generateUniqueCode();
            }
        });
    }
// genera un  codiggo unico para el producto
    private static function generateUniqueCode()
    {
        do{
            $code = str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (self::where('codigo', $code)->exists());

        return $code;
    }


    public function getNombreCompletoAttribute(): string
    {

        return "codigo: {$this->codigo} - {$this->nombre} - presentacion: {$this->presentacione->sigla}";
    }
}
