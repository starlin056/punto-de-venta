<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Container\Attributes\Storage as AttributesStorage;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductoService
{
    /**
     * Crear registro de un producto.
     */
    public function crearProducto(array $data): Producto
    {
        $producto = Producto::create([
            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'img_path' => isset($data['img_path']) && $data['img_path']
                ? $this->handleUploadImage($data['img_path'])
                : null,
            'marca_id' => $data['marca_id'],
            'categoria_id' => $data['categoria_id'],
            'presentacione_id' => $data['presentacione_id'],
        ]);

        return $producto;
    }
    /** Editar un Registro */

    public function editarProducto(array $data, Producto $producto): producto
    {

        $producto->update([

            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'img_path' => isset($data['img_path']) && $data['img_path']
                ? $this->handleUploadImage($data['img_path'], $producto->img_path)
                : $producto->img_path,
            'marca_id' => $data['marca_id'],
            'categoria_id' => $data['categoria_id'],
            'presentacione_id' => $data['presentacione_id'],


        ]);

        return $producto;
    }



    /**
     * Guarda una imagen en el almacenamiento y retorna la URL del archivo.
     */
    private function handleUploadImage($image, string $img_path = null): string
    {

        if ($img_path) {
            $relative_path = str_replace('storage/', '', $img_path);

            if (Storage::disk('public')->exists($img_path)) {
                Storage::disk('public')->delete($img_path);
            }
        }
        $name = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('productos', $name, 'public');
        return Storage::url($path); // Devuelve la URL pública
    }
}
