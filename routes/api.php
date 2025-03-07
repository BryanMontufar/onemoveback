<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\autosController;

Route::get('/autos', [autosController::class,'index']);


Route::get('/autos/{id}', function () {
    return 'obteniendo un estudiante';
});

Route::post('/autos', [autosController::class,'store']);

Route::put('/autos/{id}', function () {
    return 'actualizando autos';
});

Route::delete('/autos', function () {
    return 'eliminando autos';
});