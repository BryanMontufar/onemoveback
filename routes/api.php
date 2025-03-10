<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\autosController;

Route::get('/autos', [autosController::class,'index']);

Route::get('/autos/{id}', [autosController::class, 'show']);

Route::post('/autos', [autosController::class,'store']);

Route::put('/autos/{id}', [autosController::class, 'update']);

Route::delete('/autos/{id}', [autosController::class, 'delete']);
