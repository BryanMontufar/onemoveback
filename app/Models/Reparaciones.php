<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Autos;

class Reparaciones extends Model
{
    use HasFactory;
    
    protected $table = 'costos_reparacion';

    protected $fillable = [
        'auto_id',
        'lavada',
        'detailing',
        'pulida',
        'pintura',
        'electrico',
        'mecanica',
        'gasolina',
        'publicacion',
        'fotos',
        'papeles',
        'poder',
        'varios',
        'autostudio',
        'accesorios',
        'cargas',
        'avaluo',
        'fideval',
        'costo_total_preparacion',
        'canc_consg',
        'estado_ctr',
    ];

    public function auto()
    {
        return $this->belongsTo(Autos::class, 'auto_id'); 
    }
}