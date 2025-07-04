<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::insert([
            [
                'nombre' => 'Cedula',
            ],
            [
                'tipo_documento' => 'Pasaporte',
            ],
            [
                'tipo_documento' => 'Rnc',
            ],
            [
                'tipo_documento' => 'Carnet',
            ],
        ]);
    }
}
