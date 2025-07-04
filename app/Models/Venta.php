<?php

namespace App\Models;

use App\Observers\VentaObsever;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy(VentaObsever::class)]

class Venta extends Model
{
    use HasFactory;

    // Protege el atributo 'id' de la asignación masiva
    protected $guarded = ['id'];


    public function caja(): BelongsTo
    {
        return $this->belongsTo(caja::class);
    }


    /**
     * Relación muchos a uno con el modelo Cliente.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación muchos a uno con el modelo User.
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación muchos a uno con el modelo Comprobante.
     */
    public function comprobante():BelongsTo
    {
        return $this->belongsTo(Comprobante::class);
    }

    /**
     * Relación muchos a muchos con el modelo Producto.
     * Incluye marcas de tiempo y atributos adicionales en la tabla pivote.
     */
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class)
        ->withTimestamps()
        ->withPivot('cantidad', 'precio_venta');
    }

            /**
     * obtener solo la fecha.
     */
    public function getFechaAttribute():string
    {
        return Carbon::parse($this->fecha_hora)->format('d-m-Y');
    }


        /**
     * obtener solo la hora.
     */
    public function getHoraAttribute():string
    {
        return Carbon::parse($this->fecha_hora)->format('H:i');
    }

    /** Generar el numero de venta */

    public function generarNumeroVenta(int $cajaId, string $tipoComprobante): string
    {
        // determinar el prefijo segun el tipo de comprobante
        $prefijo = strtoupper(substr($tipoComprobante, 0, 1)); // B boleta, F para factura

        // obtener la ultima venta de la caja
         $ultimaVenta = venta::where('caja_id', $cajaId)
         ->latest('id') // ordenar por la mas reciente
         ->first();

         // Extraer lla parte Numerica del Numero de venta o comenzar desde 1
         $ultimoNumero = $ultimaVenta
         ? (int) substr($ultimaVenta->numero_comprobante, 7)  //"0000001" -> 1
         : 0;
         // incrementar en 1 
         $nuevoNumero = $ultimoNumero + 1;

         // formater el numero de venta
         $numeroVenta = sprintf("%s%03d - %07d", $prefijo, $cajaId, $nuevoNumero);

         return $numeroVenta;

    }   
}