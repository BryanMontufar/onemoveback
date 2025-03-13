<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostosReparacionTable extends Migration
{
    public function up()
    {
        Schema::create('costos_reparacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->decimal('lavada', 10, 2)->nullable();
            $table->decimal('detailing', 10, 2)->nullable();
            $table->decimal('pulida', 10, 2)->nullable();
            $table->decimal('pintura', 10, 2)->nullable();
            $table->decimal('electrico', 10, 2)->nullable();
            $table->decimal('mecanica', 10, 2)->nullable();
            $table->decimal('gasolina', 10, 2)->nullable();
            $table->decimal('publicacion', 10, 2)->nullable();
            $table->decimal('fotos', 10, 2)->nullable();
            $table->decimal('papeles', 10, 2)->nullable();
            $table->decimal('poder', 10, 2)->nullable();
            $table->decimal('varios', 10, 2)->nullable();
            $table->decimal('autostudio', 10, 2)->nullable();
            $table->decimal('accesorios', 10, 2)->nullable();
            $table->decimal('cargas', 10, 2)->nullable();
            $table->decimal('avaluo', 10, 2)->nullable();
            $table->decimal('fideval', 10, 2)->nullable();
            $table->decimal('costo_total_preparacion', 10, 2)->nullable();
            $table->decimal('canc_consg', 10, 2)->nullable();
            $table->string('estado_ctr')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('costos_reparacion');
    }
}