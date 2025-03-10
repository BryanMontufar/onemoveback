<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Controllers\Api\autosController;
use App\Http\Controllers\Api\CompraController;

Route::get('/autos', [autosController::class,'index']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/autos/{id}', [autosController::class, 'show']);

Route::post('/autos', [autosController::class,'store']);

Route::put('/autos/{id}', [autosController::class, 'update']);

Route::delete('/autos/{id}', [autosController::class, 'delete']);

Route::post('/compras', [CompraController::class, 'store']);

//PRIVATE ROUTES
Route::middleware([IsUserAuth::class])->group(function(){
   
    Route::controller(AuthController::class)->group(function(){
        Route::post('logout', 'logout');
        Route::get('me', 'getUser');
    });
});