<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Autos;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'auto_id',
        'comision_venta',
        'comisionista_venta',
        'estado_pago_comision',
        'costo_final_auto',
        'fecha_venta',
        'comprador',
        'forma_pago',
        'papeles',
        'notaria',
        'placa_rpp',
        'observaciones',
        'valor_vendido',
        'valor_abonado',
        'saldo',
        'estado_cobro',
        'fecha_cobro',
    ];

    public function auto()
    {
        return $this->belongsTo(Autos::class, 'auto_id');
    }
}
