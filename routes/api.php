<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RelatorioController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('relatorios')->group(function () {

    Route::get('/resumo', [RelatorioController::class, 'resumo']);
    Route::get('/concluidas', [RelatorioController::class, 'concluidas']);
    Route::get('/por-status', [RelatorioController::class, 'porStatus']);
    Route::get('/por-usuario', [RelatorioController::class, 'porUsuario']);
    Route::get('/por-periodo', [RelatorioController::class, 'porPeriodo']);

});