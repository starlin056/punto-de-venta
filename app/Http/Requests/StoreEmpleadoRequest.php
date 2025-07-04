<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'razon_social' => ['required', 'string', 'max:255'],
            'cargo'        => ['required', 'string', 'max:255'],
            'img'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'img.image' => 'El archivo debe ser una imagen válida.',
            'img.mimes' => 'Solo formatos jpeg, png, jpg, gif o svg.',
            'img.max'   => 'Máximo 2 MB de tamaño.',
        ];
    }
}
