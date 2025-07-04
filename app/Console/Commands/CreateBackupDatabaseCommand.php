<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CreateBackupDatabaseCommand extends Command
{
    protected $signature = 'create-backup-database';
    protected $description = 'Creación de un Backup de la base de datos';

    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $backupPath = storage_path('backups');
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupPath . '/' . $filename;

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $mysqldumpPath = '"C:\\xampp\\mysql\\bin\\mysqldump.exe"';

        if (!empty($password)) {
            $command = "{$mysqldumpPath} -u\"{$username}\" -p\"{$password}\" -h\"{$host}\" \"{$database}\" > \"{$filePath}\"";
        } else {
            $command = "{$mysqldumpPath} -u\"{$username}\" -h\"{$host}\" \"{$database}\" > \"{$filePath}\"";
        }

        $process = \Symfony\Component\Process\Process::fromShellCommandline($command);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info("✅ Backup creado exitosamente: {$filePath}");
        } else {
            $this->error("❌ Error al crear el backup:");
            $this->error("Código de salida: " . $process->getExitCode());
            $this->error("Salida de error: " . $process->getErrorOutput());
        }
    }
}
