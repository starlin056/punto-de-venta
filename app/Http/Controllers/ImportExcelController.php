<?php

namespace App\Http\Controllers;

use App\Imports\EmpleadosImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function ImportExcelEmpleados(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new EmpleadosImport, $request->file('file'));


        return redirect()->route('empleados.index')->with('success', 'All good!');
    }
}
