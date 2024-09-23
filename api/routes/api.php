<?php

use App\Http\Controllers\Auth\AutenticacaoController;
use App\Http\Controllers\Documento\ArquivosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registro', [AutenticacaoController::class, 'registro']);
Route::post('/login', [AutenticacaoController::class, 'login']);

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->user(); // Retorna o usuário autenticado
});

Route::middleware('auth:sanctum')->post('/arquivo/upload', [ArquivosController::class, 'upload']);