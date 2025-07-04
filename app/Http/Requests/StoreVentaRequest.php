<?php

namespace App\Http\Requests;

use App\Enums\MetodoPagoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;      // ← import correcto

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id'     => 'required|exists:clientes,id',
            'comprobante_id' => 'required|exists:comprobantes,id',
            'metodo_pago'    => ['required', new Enum(MetodoPagoEnum::class)],  // ← usa Enum de Laravel
            'subtotal'       => 'required|min:1',     // además corrige este typo si lo tienes así
            'impuesto'       => 'required',
            'total'          => 'required|numeric',
            'monto_recibido' => 'required|numeric|min:1',
            'vuelto_entregado' => 'required|numeric|min:0',
        ];
    }
}
