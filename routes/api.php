<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Controllers\Api\autosController;
use App\Http\Controllers\Api\CompraController;
use App\Http\Controllers\Api\reparacionesController;
use App\Models\Compra;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/compras', [CompraController::class,'index']);
Route::get('/autos/{id}', [autosController::class, 'show']);
Route::get('/compras/{id}', [CompraController::class, 'show']);
Route::get('/reparaciones/{id}', [reparacionesController::class, 'show']);
Route::get('/autos', [autosController::class,'index']);
Route::get('/reparaciones', [autosController::class,'index']);

Route::post('/autos', [autosController::class,'store']);
Route::post('/compras', [CompraController::class, 'store']);
Route::post('/reparaciones', [reparacionesController::class, 'store']);

Route::put('/autos/{id}', [autosController::class, 'update']);
Route::put('/compras/{id}', [CompraController::class, 'update']);
Route::put('/reparaciones/{id}', [reparacionesController::class, 'update']);

Route::delete('/autos/{id}', [autosController::class, 'delete']);

Route::post('/compras', [CompraController::class, 'store']);

//PRIVATE ROUTES
Route::middleware([IsUserAuth::class])->group(function(){
   
    Route::controller(AuthController::class)->group(function(){
        Route::post('logout', 'logout');
        Route::get('me', 'getUser');
    });
});