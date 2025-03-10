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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->string('vendedor');
            $table->string('cedula_ruc');
            $table->decimal('valor_auto', 10, 2);
            $table->decimal('abono', 10, 2)->default(0);
            $table->decimal('saldo_pagar', 10, 2);
            $table->date('fecha_pago')->nullable();
            $table->string('estado');
            $table->decimal('matri_rev_mul', 10, 2)->default(0);
            $table->decimal('comision_compra', 10, 2)->default(0);
            $table->string('comisionista_compra')->nullable();
            $table->string('estado_comision_compra')->nullable();
            $table->decimal('precio_final_compra', 10, 2);
            $table->string('forma_pago')->nullable();
            $table->string('placa_rpp')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
