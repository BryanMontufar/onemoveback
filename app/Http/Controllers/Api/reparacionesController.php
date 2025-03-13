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

            $data = [
                'message' => 'no se encontraron autos',
                'status' => 200
            ];
            return response()->json($data, 400);
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

        $reparaciones = Reparaciones::create($request->all());

        return response()->json(['message' => 'Compra registrada con éxito', 'compra' => $reparaciones], 201);
    }

    public function show($auto_id)
    {
        $reparaciones = Reparaciones::where('auto_id', $auto_id)->first();

        if (!$reparaciones) {
            return response()->json([
                'message' => 'No se encontró una compra para este auto',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'compra' => $reparaciones,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $reparaciones = Reparaciones::find($id);
        if (!$reparaciones) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validación de los datos recibidos
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

        // Si hay errores en la validación, devolverlos
        if ($validator->fails()) {
            $data = [
                'message' => 'error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $reparaciones->lavada = $request->lavada;
        $reparaciones->detailing = $request->detailing;
        $reparaciones->pulida = $request->pulida;
        $reparaciones->pintura = $request->pintura;
        $reparaciones->electrico = $request->electrico;
        $reparaciones->mecanica = $request->mecanica;
        $reparaciones->gasolina = $request->gasolina;
        $reparaciones->publicacion = $request->publicacion;
        $reparaciones->fotos = $request->fotos;
        $reparaciones->papeles = $request->papeles;
        $reparaciones->poder = $request->poder;
        $reparaciones->varios = $request->varios;
        $reparaciones->autostudio = $request->autostudio;
        $reparaciones->accesorios = $request->accesorios;
        $reparaciones->cargas = $request->cargas;
        $reparaciones->avaluo = $request->avaluo;
        $reparaciones->fideval = $request->fideval;
        $reparaciones->costo_total_preparacion = $request->costo_total_preparacion;
        $reparaciones->canc_consg = $request->canc_consg;
        $reparaciones->estado_ctr = $request->estado_ctr;

        $reparaciones->save();
        $data = [
            'message' => 'actualizado',
            'autos' => $reparaciones,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
