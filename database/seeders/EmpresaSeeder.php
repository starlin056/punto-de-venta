<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::insert([
            'nombre' => 'vocauto',
            'propietario' => 'Pedro ureña',
            'rnc' => '132653025',
            'porcentaje_impuesto' => '18',
            'abreviatura_impuesto' => 'ITBIS',
            'direccion' => 'Av.principal  nº105 punta cana',
            'moneda_id' => 2
        ]);
    }
}
