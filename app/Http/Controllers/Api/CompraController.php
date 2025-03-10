<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compra;

class CompraController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'auto_id' => 'required|exists:autos,id',
            'vendedor' => 'required|string',
            'cedula_ruc' => 'required|string',
            'valor_auto' => 'required|numeric',
            'abono' => 'numeric',
            'saldo_pagar' => 'required|numeric',
            'fecha_pago' => 'nullable|date',
            'estado' => 'required|string',
            'matri_rev_mul' => 'numeric',
            'comision_compra' => 'numeric',
            'comisionista_compra' => 'nullable|string',
            'estado_comision_compra' => 'nullable|string',
            'precio_final_compra' => 'required|numeric',
            'forma_pago' => 'nullable|string',
            'placa_rpp' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $compra = Compra::create($request->all());

        return response()->json(['message' => 'Compra registrada con éxito', 'compra' => $compra], 201);
    }
}