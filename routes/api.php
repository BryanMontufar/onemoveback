<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\IsUserAuth;
use App\Http\Controllers\Api\autosController;
use App\Http\Controllers\Api\CompraController;
use App\Http\Controllers\Api\reparacionesController;
use App\Http\Controllers\Api\ventasController;
use App\Http\Controllers\Api\UserController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/compras', [CompraController::class,'index']);
Route::get('/autos/{id}', [autosController::class, 'show']);
Route::get('/compras/{id}', [CompraController::class, 'show']);
Route::get('/reparaciones/{id}', [reparacionesController::class, 'show']);
Route::get('/autos', [autosController::class,'index']);
Route::get('/reparaciones', [reparacionesController::class,'index']);
Route::get('/ventas', [VentasController::class,'index']);
Route::get('/ventas/{id}', [ventasController::class, 'show']);

Route::post('/autos', [autosController::class,'store']);
Route::post('/compras', [CompraController::class, 'store']);
Route::post('/reparaciones', [reparacionesController::class, 'store']);
Route::post('/ventas', [VentasController::class, 'store']);

Route::put('/autos/{id}', [autosController::class, 'update']);
Route::put('/compras/{id}', [CompraController::class, 'update']);
Route::put('/reparaciones/{id}', [reparacionesController::class, 'update']);
Route::put('/ventas/{id}', [ventasController::class, 'update']);

Route::get('user', [UserController::class, 'index']); // Mostrar todos los usuarios
Route::post('user', [UserController::class, 'store']); // Crear un nuevo usuario
Route::get('/user/search', [UserController::class, 'search']); // Búsqueda de usuarios
Route::put('user/{id}', [UserController::class, 'update']); // Editar un usuario
Route::delete('user /{id}', [UserController::class, 'destroy']); // Eliminar un usuario
Route::delete('/autos/{id}', [autosController::class, 'delete']);

//PRIVATE ROUTES
Route::middleware([IsUserAuth::class])->group(function(){
   
    Route::controller(AuthController::class)->group(function(){
        Route::post('logout', 'logout');
        Route::get('me', 'getUser');
    });
});