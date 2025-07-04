<?php

namespace Database\Seeders;

use App\Models\Moneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Moneda::insert([
            [
                'estandar_iso' => 'USD',
                'nombre_completo' => 'Dolar estadounidense',
                'simbolo' => '$'
            ],

            [
                'estandar_iso' => 'DOP',
                'nombre_completo' => 'Peso Dominicano',
                'simbolo' => 'RD$'
            ]
        ]);
    }
}
