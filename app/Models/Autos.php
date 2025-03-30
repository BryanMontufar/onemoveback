<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compra;

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
    public function compras()
    {
        return $this->hasMany(Compra::class, 'auto_id');
        $autoCount = Autos::count(); // Contamos el total de autos

    return view('dashboard', compact('autoCount')); // Pasamos la variable autoCount a la vista
    }
}
