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
                'message'=> 'no se encontraron autos',
                'status'=> 200
            ];
            return response()->json($data, 400);
        }
        return response()->json($autos, 200);
    }

    public function store(Request $request)
    {

    $validator = Validator::make($request->all(), [

        'acta' => 'required',
        'placa'=> 'required',
        'marca'=> 'required',
        'modelo'=> 'required',
        'kilometraje'=> 'required',
        'anio'=> 'required',
        'color'=> 'required',
        'estatus' => 'required',
        'fecha_ingreso' => 'required|date'
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'error en la validacion',
            'error' => $validator->errors(),
            'status' => 400,
        ];
        return response()-> json($data,400);
    }

    $autos = Autos::create([

        'acta' => $request -> acta,
        'placa'=> $request -> placa,
        'marca'=> $request -> marca,
        'modelo'=> $request -> modelo,
        'kilometraje'=> $request -> kilometraje,
        'anio'=> $request -> anio,
        'color'=> $request -> color,
        'estatus' =>$request -> estatus,
        'fecha_ingreso' =>$request -> fecha_ingreso
    ]);

    if (!$autos){
        $data = [
            'message' => 'error al crear auto',
            'status' => 500
        ];

        return response()->json($data,500);
    }

    $data = [
        'autos' => $autos,
        'status' => 201
    ];

    return response()->json($data,201);
}
}
