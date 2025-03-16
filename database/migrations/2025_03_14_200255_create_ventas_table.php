<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->decimal('comision_venta', 10, 2); // Comisión Venta
            $table->string('comisionista_venta'); // Comisionista Venta
            $table->string('estado_pago_comision'); // Estado de Pago Comisión Venta
            $table->decimal('costo_final_auto', 10, 2); // Costo Final Auto
            $table->date('fecha_venta'); // Fecha Venta
            $table->string('comprador'); // Comprador
            $table->string('forma_pago'); // Forma de Pago
            $table->integer('papeles'); // Papeles
            $table->string('notaria'); // Notaría
            $table->string('placa_rpp'); // Placa RPP
            $table->text('observaciones')->nullable(); // Observaciones
            $table->decimal('valor_vendido', 10, 2); // Valor Vendido
            $table->decimal('valor_abonado', 10, 2); // Valor Abonado
            $table->decimal('saldo', 10, 2); // Saldo
            $table->string('estado_cobro'); // Estado de Cobro
            $table->date('fecha_cobro')->nullable(); // Fecha Cobro
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
