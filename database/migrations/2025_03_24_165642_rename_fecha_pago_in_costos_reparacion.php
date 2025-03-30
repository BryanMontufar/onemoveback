<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('costos_reparacion', function (Blueprint $table) {
            $table->renameColumn('fecha_pago', 'fecha_pago_reparacion');
        });
    }

    public function down()
    {
        Schema::table('costos_reparacion', function (Blueprint $table) {
            $table->renameColumn('fecha_pago_reparacion', 'fecha_pago');
        });
    }
};

