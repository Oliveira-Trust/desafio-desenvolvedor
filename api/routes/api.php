<?php

use App\Http\Controllers\AutenticacaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registro', [AutenticacaoController::class, 'registro']);
Route::post('/login', [AutenticacaoController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AutenticacaoController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



