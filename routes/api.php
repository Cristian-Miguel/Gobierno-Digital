<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*** Inicio de sesion ***/
Route::post('/login',             [UserController::class, 'login']);

Route::middleware('auth:api')->group(function(){
    Route::post('/logout', [UserController::class, 'logout']);

    /*** Rutas del Usuario  ***/
    Route::post('/crear_usuario',     [UserController::class, 'store']);
    Route::put('/actualizar_usuario', [UserController::class, 'update']);
    Route::delete('/borrar_usuario',  [UserController::class, 'destroy']);
    Route::get('/listar_usuarios',     [UserController::class, 'index']);
    Route::get('/mostrar_usuario',     [UserController::class, 'show']);

    /*** Rutas de Role  ***/
    Route::post('/crear_rol',     [RoleController::class, 'store']);
    Route::put('/actualizar_rol', [RoleController::class, 'update']);
    Route::delete('/borrar_rol',  [RoleController::class, 'destroy']);
    Route::get('/listar_rol',     [RoleController::class, 'index']);
    Route::get('/mostrar_rol',     [RoleController::class, 'show']);
});
