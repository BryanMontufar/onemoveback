<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('acta');
            $table->string('placa');
            $table->string('marca');
            $table->string('modelo');
            $table->string('kilometraje');
            $table->string('anio');
            $table->string('color');
            $table->string('estatus');
            $table->date('fecha_ingreso')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
