<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->route('home');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'auth')->name('auth');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->controller(ArquivoController::class)->group(function () {
    Route::get('home', 'arquivos')->name('home');
    Route::get('importar-arquivo', 'importar')->name('importar.arquivo');
    Route::get('conteudo-arquivo/{id}', 'conteudo')->name('conteudo.arquivo');
    Route::get('historico-arquivo', 'historico')->name('historico.arquivo');
});
