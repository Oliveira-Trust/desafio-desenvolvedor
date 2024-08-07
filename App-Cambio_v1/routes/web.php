<?php

use App\Http\Controllers\ConversaoController;
use App\Http\Controllers\HomeController;

Route::post('/converter', [ConversaoController::class, 'converter'])->name('converter');
Route::get('/moedas', [ConversaoController::class, 'listarMoedas'])->name('listarMoedas');
Route::get('/conversao', [ConversaoController::class, 'index'])->name('conversao');
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
