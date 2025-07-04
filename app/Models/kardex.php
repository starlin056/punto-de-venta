<?php

namespace App\Models;

use App\Enums\TipoPersonaEnum;
use App\Enums\TipoTransaccionEnum;

use Exception;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Log\log;

class kardex extends Model
{
    protected $guarded = ['id'];

    protected $table = 'kardex';

    protected $casts = ['tipo_transaccion' => TipoTransaccionEnum::class];

    private  const MARGEN_GANANCIA = 0.3;

    public function producto(): BelongsTo
    {

        return $this->belongsTo(kardex::class);
    }

    public function crearRegistro(array $data, TipoTransaccionEnum $tipo): void
    {
        $entrada = null;
        $salida = null;
        $saldo = null;

        $ultimoRegistro = $this->where('producto_id', $data['producto_id'])
            ->latest('id')
            ->first();

        $saldo = $ultimoRegistro ? $ultimoRegistro->saldo : $data['cantidad'];

        if ($tipo == TipoTransaccionEnum::compra) {
            $entrada = $data['cantidad'];
            $saldo += $entrada;
        }elseif($tipo == TipoTransaccionEnum::venta || $tipo == TipoTransaccionEnum::Ajuste){
            $salida = $data['cantidad'];
            $saldo-= $salida;
        }

       /** if ($tipo == TipoTransaccionEnum::compra) {
          *  $entrada = $data['entrada'];
          ********$entrada = $data['entrada'] ?? null; // Asigna null si 'entrada' no está definida******
        *} */

        try {
            $this->create([
                'producto_id' => $data['producto_id'],
                'tipo_transaccion' => $tipo->value,
                'descripcion_transaccion' => $this->getDescripcionTransaccion($data, $tipo),
                'entrada' => $entrada,
                'salida' => $salida,
                'saldo' => $saldo,
                'costo_unitario' => $data['costo_unitario'],
            ]);
        } catch (Exception $e) {

            Log::error("Error al crear un registro en el cardex", ['error' => $e->getMessage()]);
        }
    }


    private function getDescripcionTransaccion(array $data, TipoTransaccionEnum $tipo): string
    {
        $descripcion = '';
        switch ($tipo) {
            case TipoTransaccionEnum::Apertura:
                $descripcion = 'Apertura del producto';
                break;
            case TipoTransaccionEnum::compra:
                $descripcion = 'Entrada de producto por la compra #' . $data['compra_id'];
                break;
            case TipoTransaccionEnum::venta:
                $descripcion = 'Salida de producto por la Venta #' . $data['venta_id'];
                 break;
            case TipoTransaccionEnum::Ajuste:
                $descripcion = 'Ajuste de producto';
               break;
        }

        return $descripcion;
    }

    public function getFechaAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }


    public function getHoraAttribute(): string
    {

        return $this->created_at->format('h:i A');
    }

    public function getCostoTotalAttribute(): float
    {

        return $this->saldo * $this->costo_unitario;
    }



    public function calcularPrecioVenta(int $producto_id)
    {
        $costoUltimoRegiistro = $this->where('producto_id', $producto_id)
            ->latest('id')
            ->first()
            ->costo_unitario;

        return $costoUltimoRegiistro + round($costoUltimoRegiistro * self::MARGEN_GANANCIA, 3);
    }
}
