<?php

namespace App\Console\Commands;

use App\Models\ubicacione;
use Illuminate\Console\Command;
use Throwable;

class CreateUbicacionesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-ubicacione';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creacion para un registro de una ubicacion';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nombre = $this->ask('Ingrese el nombre para su nueva ubicacion');

        try {
            ubicacione::create([
                'nombre' => $nombre
            ]);

            $this->info('Ubicacion creada exitosamente');
        } catch (Throwable $e) {
            $this->error('Ups, algo fallo' . $e->getMessage());

        }
    }
}
