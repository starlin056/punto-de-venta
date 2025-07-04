<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
{

    public function authorize(): bool
    {

        return true;
    }


    public function rules(): array
    {
        return [
            'producto_id' => 'required|exists:productos,id',
            'ubicacione_id' => 'required|exists:ubicaciones,id',
            'cantidad' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'nullable|date',
            'costo_unitario' => 'required|numeric|min:0.1'
        ];
    }
}
