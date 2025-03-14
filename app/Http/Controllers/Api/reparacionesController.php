<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reparaciones;
use Illuminate\Support\Facades\Validator;

class reparacionesController extends Controller
{
    public function index()
    {
        $reparaciones = Reparaciones::all();

        if ($reparaciones->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron reparaciones',
                'status' => 200
            ], 400);
        }

        return response()->json($reparaciones, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'auto_id' => 'required|exists:autos,id',
            'lavada' => 'nullable|numeric',
            'detailing' => 'nullable|numeric',
            'pulida' => 'nullable|numeric',
            'pintura' => 'nullable|numeric',
            'electrico' => 'nullable|numeric',
            'mecanica' => 'nullable|numeric',
            'gasolina' => 'nullable|numeric',
            'publicacion' => 'nullable|numeric',
            'fotos' => 'nullable|numeric',
            'papeles' => 'nullable|numeric',
            'poder' => 'nullable|numeric',
            'varios' => 'nullable|numeric',
            'autostudio' => 'nullable|numeric',
            'accesorios' => 'nullable|numeric',
            'cargas' => 'nullable|numeric',
            'avaluo' => 'nullable|numeric',
            'fideval' => 'nullable|numeric',
            'costo_total_preparacion' => 'nullable|numeric',
            'canc_consg' => 'nullable|numeric',
            'estado_ctr' => 'nullable|string',
            'fecha_pago' => 'nullable|date',
        ]);

        $reparacion = Reparaciones::create($request->all());

        return response()->json([
            'message' => 'Reparación registrada con éxito',
            'reparacion' => $reparacion
        ], 201);
    }

    public function show($auto_id)
    {
        $reparacion = Reparaciones::where('auto_id', $auto_id)->first();

        if (!$reparacion) {
            return response()->json([
                'message' => 'No se encontró una reparación para este auto',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'reparacion' => $reparacion,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $reparacion = Reparaciones::find($id);

        if (!$reparacion) {
            return response()->json([
                'message' => 'Reparación no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'auto_id' => 'required|exists:autos,id',
            'lavada' => 'nullable|numeric',
            'detailing' => 'nullable|numeric',
            'pulida' => 'nullable|numeric',
            'pintura' => 'nullable|numeric',
            'electrico' => 'nullable|numeric',
            'mecanica' => 'nullable|numeric',
            'gasolina' => 'nullable|numeric',
            'publicacion' => 'nullable|numeric',
            'fotos' => 'nullable|numeric',
            'papeles' => 'nullable|numeric',
            'poder' => 'nullable|numeric',
            'varios' => 'nullable|numeric',
            'autostudio' => 'nullable|numeric',
            'accesorios' => 'nullable|numeric',
            'cargas' => 'nullable|numeric',
            'avaluo' => 'nullable|numeric',
            'fideval' => 'nullable|numeric',
            'costo_total_preparacion' => 'nullable|numeric',
            'canc_consg' => 'nullable|numeric',
            'estado_ctr' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $reparacion->update($request->all());

        return response()->json([
            'message' => 'Reparación actualizada con éxito',
            'reparacion' => $reparacion,
            'status' => 200
        ], 200);
    }
}
