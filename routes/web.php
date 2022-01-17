<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversaoController;

Route::get('/conversoes/cotacaoatual/{moeda}', [ConversaoController::class, 'cotacaoAtual']);
Route::get('/conversoes/calcular/{valororigem}/{cotacaoatual}/{formadepagamento}', [ConversaoController::class, 'calcular']);
Route::get('/conversoes', [ConversaoController::class, 'index']);
Route::get('/conversoes/create', [ConversaoController::class, 'create']);
Route::get('/conversoes/{id}', [ConversaoController::class, 'show']);
Route::get('/conversoes/destroy/{id}', [ConversaoController::class, 'destroy']);
Route::post('/conversoes', [ConversaoController::class, 'store']);
