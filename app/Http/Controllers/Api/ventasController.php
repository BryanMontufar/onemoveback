<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ventasController extends Controller
{
    public function index()
    {
        $ventas = Ventas::all();

        if ($ventas->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron ventas',
                'status' => 200
            ], 400);
        }

        return response()->json($ventas, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'auto_id' => 'required|exists:autos,id',
            'comision_venta' => 'required|numeric',
            'comisionista_venta' => 'required|string|max:255',
            'estado_pago_comision' => 'required|string|max:255',
            'costo_final_auto' => 'required|numeric',
            'fecha_venta' => 'required|date',
            'comprador' => 'required|string|max:255',
            'forma_pago' => 'required|string|max:255',
            'papeles' => 'required|string|max:255',
            'notaria' => 'required|numeric',
            'placa_rpp' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'valor_vendido' => 'required|numeric',
            'valor_abonado' => 'required|numeric',
            'saldo' => 'required|numeric',
            'estado_cobro' => 'required|string|max:255',
            'fecha_cobro' => 'nullable|date',
        ]);

        $ventas = Ventas::create($request->all());

        return response()->json([
            'message' => 'Venta registrada con éxito',
            'ventas' => $ventas
        ], 201);
    }

    public function show($auto_id)
    {
        $ventas = Ventas::where('auto_id', $auto_id)->first();

        if (!$ventas) {
            return response()->json([
                'message' => 'No se encontró una ventas para este auto',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'ventas' => $ventas,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $ventas = Ventas::find($id);

        if (!$ventas) {
            return response()->json([
                'message' => 'venta no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'auto_id' => 'required|exists:autos,id',
            'comision_venta' => 'required|numeric',
            'comisionista_venta' => 'required|string|max:255',
            'estado_pago_comision' => 'required|string|max:255',
            'costo_final_auto' => 'required|numeric',
            'fecha_venta' => 'required|date',
            'comprador' => 'required|string|max:255',
            'forma_pago' => 'required|string|max:255',
            'papeles' => 'required|string|max:255',
            'notaria' => 'required|numeric',
            'placa_rpp' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'valor_vendido' => 'required|numeric',
            'valor_abonado' => 'required|numeric',
            'saldo' => 'required|numeric',
            'estado_cobro' => 'required|string|max:255',
            'fecha_cobro' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $ventas->update($request->all());

        return response()->json([
            'message' => 'Venta actualizada con éxito',
            'ventas' => $ventas,
            'status' => 200
        ], 200);
    }
}
