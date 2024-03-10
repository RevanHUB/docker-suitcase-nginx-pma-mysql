<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Controllers */
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ComerciosController;
use App\Http\Controllers\AyuntamientosController;
use App\Http\Controllers\ParticularesController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\EtiquetasController;
use App\Http\Controllers\SeguidosController;

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




    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResource('users', UsersController::class);
        Route::apiResource('comercios', ComerciosController::class);
        Route::apiResource('ayuntamientos', AyuntamientosController::class);
        Route::apiResource('particulares', ParticularesController::class);
        Route::apiResource('publicaciones', PublicacionesController::class);
        Route::apiResource('etiquetas', EtiquetasController::class);
        Route::apiResource('seguidos', SeguidosController::class);
        Route::post('borrarseguidos', [SeguidosController::class, 'borrar_seguidor']);
        Route::get('obtenerseguidos/{id}', [SeguidosController::class, 'obtener_seguidos']);
    });

    Route::post('login', [AuthenticateController::class, 'login'])->name('login');
    Route::post('logout', [AuthenticateController::class, 'logout']);



