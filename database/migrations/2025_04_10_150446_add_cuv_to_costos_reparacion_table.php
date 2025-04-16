<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;
use App\Models\Autos;
use App\Models\Compra;
use App\Models\Reparaciones;
use App\Models\Ventas;
use League\Csv\Reader;
use Carbon\Carbon;

return new class extends Migration
{
    public function up()
    {
        Schema::table('costos_reparacion', function (Blueprint $table) {
            $table->string('CUV')->nullable()->after('fideval'); // Puedes cambiar el "after" a la columna que desees
        });
    }

    public function down()
    {
        Schema::table('costos_reparacion', function (Blueprint $table) {
            $table->dropColumn('CUV');
        });
    }
};
