<?php

use App\Http\Controllers\ConversaoController;


Route::get('/', [ConversaoController::class, 'index']);
Route::post('/converter', [ConversaoController::class, 'converter'])->name('converter');
Route::get('/moedas', [ConversaoController::class, 'listarMoedas'])->name('listarMoedas');
Route::get('/conversao', [ConversaoController::class, 'index'])->name('conversao');


