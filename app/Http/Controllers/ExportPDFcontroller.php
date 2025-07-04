<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class ExportPDFcontroller extends Controller
{
    public function exportPDFComprobanteVenta(Request $request)
    {

        //descencriptar la informacion de la factura
        $id = Crypt::decrypt($request->id);

        $venta = Venta::findOrfail($id);
        $empresa = Empresa::first();

        $pdf = Pdf::loadView('pdf.comprobante-venta', [
            'venta' => $venta,
            'empresa' => $empresa
        ]);
        return $pdf->stream('venta' . $venta->id);

        
    }
}
