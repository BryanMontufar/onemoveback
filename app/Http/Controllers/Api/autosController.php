<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Autos;
use Illuminate\Support\Facades\Validator;

class autosController extends Controller
{
    public function index()
    {
        $autos = Autos::all();

        if ($autos->isEmpty()) {

            $data = [
                'message' => 'no se encontraron autos',
                'status' => 200
            ];
            return response()->json($data, 400);
        }
        return response()->json($autos, 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'acta' => 'required',
            'placa' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'kilometraje' => 'required',
            'anio' => 'required',
            'color' => 'required',
            'estatus' => 'required',
            'fecha_ingreso' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'error en la validacion',
                'error' => $validator->errors(),
                'status' => 400,
            ];
            return response()->json($data, 400);
        }

        $autos = Autos::create([

            'acta' => $request->acta,
            'placa' => $request->placa,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'kilometraje' => $request->kilometraje,
            'anio' => $request->anio,
            'color' => $request->color,
            'estatus' => $request->estatus,
            'fecha_ingreso' => $request->fecha_ingreso
        ]);

        if (!$autos) {
            $data = [
                'message' => 'error al crear auto',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'autos' => $autos,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $auto = Autos::find($id);

        if (!$auto) {
            return response()->json([
                'message' => 'Auto no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'auto' => $auto,
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $autos = Autos::find($id);
        if (!$autos) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'acta' => 'required',
            'placa' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'kilometraje' => 'required',
            'anio' => 'required',
            'color' => 'required',
            'estatus' => 'required',
            'fecha_ingreso' => 'required|date'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $autos->acta = $request->acta;
        $autos->placa = $request->placa;
        $autos->marca = $request->marca;
        $autos->modelo = $request->modelo;
        $autos->kilometraje = $request->kilometraje;
        $autos->anio = $request->anio;
        $autos->color = $request->color;
        $autos->estatus = $request->estatus;
        $autos->fecha_ingreso = $request->fecha_ingreso;

        $autos->save();
        $data = [
            'message' => 'actualizado',
            'autos' => $autos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function delete($id)
    {
        $autos = Autos::find($id);
        if (!$autos) {
            $data = [
                'message' => 'Auto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $autos->delete();
        $data = [
                'message' => 'Auto eliminado',
                'status' => 200
        ];
        return response()->json($data, 200);
    }
}
