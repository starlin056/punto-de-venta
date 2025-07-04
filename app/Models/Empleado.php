<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Empleado extends Model
{
    use HasFactory;

    // Ajusta aquí según tus columnas
    protected $fillable = [
        'razon_social',
        'cargo',
        'img',   // <-- aquí guardaremos la ruta relativa, ej: "empleados/abc123.jpg"
    ];

    /**
     * Sube la imagen al disco "public" y elimina la anterior si viene $oldPath.
     * Retorna la ruta relativa dentro de storage/app/public.
     */
    public function handleUploadImage(UploadedFile $image, ?string $oldPath = null): string
    {
        // Si existe una imagen previa, la borramos
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // Generamos un nombre único
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        // La guardamos en storage/app/public/empleados
        $path = $image->storeAs('empleados', $filename, 'public');

        // Retornamos la ruta relativa
        return $path;  // ej: "empleados/abc123.jpg"
    }
}
