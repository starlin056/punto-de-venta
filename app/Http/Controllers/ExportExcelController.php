<?php

namespace App\Http\Controllers;

use App\Exports\VentasExport;
use App\Jobs\DownloadExcelVentasAlljob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function exportExcelVentasALL()
    {
        $filename = 'venta_' . now()->format('Y_m_d_His') . '.xlsx';

        //return Excel::download(new VentasExport, 'ventas.xlsx');
        DownloadExcelVentasAlljob::dispatch($filename, Auth::id());
        return redirect()->route('ventas.index')->with('success', 'Procesando descarga');
    }
}
