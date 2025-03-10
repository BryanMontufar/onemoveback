<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Autos;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'auto_id',
        'vendedor',
        'cedula_ruc',
        'valor_auto',
        'abono',
        'saldo_pagar',
        'fecha_pago',
        'estado',
        'matri_rev_mul',
        'comision_compra',
        'comisionista_compra',
        'estado_comision_compra',
        'precio_final_compra',
        'forma_pago',
        'placa_rpp',
        'observaciones'
    ];

    public function auto()
    {
        return $this->belongsTo(Autos::class, 'auto_id');
    }
}
