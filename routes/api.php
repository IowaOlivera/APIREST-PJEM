<?php

use App\Http\Controllers\AccionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\PreguntaExamenController;
use App\Http\Controllers\RespuestaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('examenes', ExamenController::class)->except(['create', 'edit']);
    Route::resource('acciones', AccionController::class)->except(['create', 'edit']);
    Route::resource('preguntas', PreguntaController::class)->except(['create', 'edit']);
    Route::resource('preguntasExamen', PreguntaExamenController::class)->except(['create', 'edit']);
    Route::resource('respuestas', RespuestaController::class)->except(['create', 'edit']);
});
