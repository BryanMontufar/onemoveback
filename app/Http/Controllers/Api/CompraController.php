<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compra;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{

    public function index()
    {
        $compras = Compra::all();

        if ($compras->isEmpty()) {

            $data = [
                'message' => 'no se encontraron autos',
                'status' => 200
            ];
            return response()->json($data, 400);
        }
        return response()->json($compras, 200);
    }

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

    public function show($auto_id)
    {
        $compra = Compra::where('auto_id', $auto_id)->first();

        if (!$compra) {
            return response()->json([
                'message' => 'No se encontró una compra para este auto',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'compra' => $compra,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validación de los datos recibidos
        $validator = Validator::make($request->all(), [
            'auto_id' => 'required|exists:autos,id',
            'vendedor' => 'required|string',
            'cedula_ruc' => 'required|string',
            'valor_auto' => 'required|numeric',
            'abono' => 'required|numeric',
            'saldo_pagar' => 'required|numeric',
            'fecha_pago' => 'nullable|date',
            'estado' => 'required|string',
            'matri_rev_mul' => 'required|numeric',
            'comision_compra' => 'required|numeric',
            'comisionista_compra' => 'nullable|string',
            'estado_comision_compra' => 'nullable|string',
            'precio_final_compra' => 'required|numeric',
            'forma_pago' => 'nullable|string',
            'placa_rpp' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        // Si hay errores en la validación, devolverlos
        if ($validator->fails()) {
            $data = [
                'message' => 'error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $compra->vendedor = $request->vendedor;
        $compra->cedula_ruc = $request->cedula_ruc;
        $compra->valor_auto = $request->valor_auto;
        $compra->abono = $request->abono;
        $compra->saldo_pagar = $request->saldo_pagar;
        $compra->fecha_pago = $request->fecha_pago;
        $compra->estado = $request->estado;
        $compra->matri_rev_mul = $request->matri_rev_mul;
        $compra->comision_compra = $request->comision_compra;
        $compra->comisionista_compra = $request->comisionista_compra;
        $compra->estado_comision_compra = $request->estado_comision_compra;
        $compra->precio_final_compra = $request->precio_final_compra;
        $compra->forma_pago = $request->forma_pago;
        $compra->placa_rpp = $request->placa_rpp;
        $compra->observaciones = $request->observaciones;

        $compra->save();
        $data = [
            'message' => 'actualizado',
            'autos' => $compra,
            'status' => 200
        ];
        return response()->json($data, 200);

    }
}