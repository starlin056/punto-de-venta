<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class VentasExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Venta::all();
    }


     /**
    * @param Invoice $invoice
    */
    public function map($venta): array
    {
        return [
            $venta->cliente->persona->razon_social,
            $venta->user->name,
            $venta->comprobante->nombre,
            $venta->numero_comprobante,
            $venta->metodo_pago,
            Carbon::parse($venta->fecha_hora)->format('d/m/y'),
            Carbon::parse($venta->fecha_hora)->format('h:i A'),
            $venta->subtotal,
            $venta->impuesto,
            $venta->total
        ];
    }


     public function headings(): array
    {
        return [
            'Cliente',
            'Cajero',
            'Comprobante',
            'Numero de ccomprobante',
            'Metodo de pago',
            'Fecha',
            'Hora',
            'Subtootal',
            'Impuesto',
            'Total'
        ];
    }

    //styles

     public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

    
        ];
    }
}
