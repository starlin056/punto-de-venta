<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * correr migracion.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->unique()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverso  miigracion.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};
