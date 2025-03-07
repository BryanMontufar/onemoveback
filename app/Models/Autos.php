<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autos extends Model
{
    use HasFactory;
    
    protected $table = 'autos';

    protected $fillable = [
      'acta',
      'placa',
      'marca',
      'modelo',
      'kilometraje',
      'anio',
      'color',
      'estatus',
      'fecha_ingreso'
    ];
}
