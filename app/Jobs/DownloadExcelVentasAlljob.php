<?php

namespace App\Jobs;

use App\Exports\VentasExport;
use App\Models\User;
use App\Notifications\ExcelVentasDescargado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class DownloadExcelVentasAlljob implements ShouldQueue
{
    use Queueable;

    protected string $filename;
    protected int $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct(string $filename, int $user_id)
    {
        $this->filename = $filename;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Excel::store(new VentasExport, 'reportesExcelVentas/'. $this->filename, 'public');

            $user = User::findOrFail($this->user_id);

            Notification::send($user, new ExcelVentasDescargado());
            
        } catch (\Throwable $e) {
            Log::error("Error al Exportar venta a Excel: " . $e->getMessage());
        }
    }
}
