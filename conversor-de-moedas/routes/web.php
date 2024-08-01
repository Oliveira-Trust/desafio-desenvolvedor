<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversorMoedasController;

Route::get('/', [ConversorMoedasController::class, 'exibirHomeConversor']);
Route::get('/conversor', [ConversorMoedasController::class, 'index']);
Route::post('/converter', [ConversorMoedasController::class, 'converter'])->name('converter');
Route::post('/enviar-email', [ConversorMoedasController::class, 'enviarEmail']);

