<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'auth')->name('auth');
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(ArquivoController::class)->group(function () {
    Route::get('/', 'arquivos')->name('home');
    Route::get('importar-arquivo', 'importar')->name('importar.arquivo');
    Route::get('historico-arquivo', 'historico')->name('historico.arquivo');
})->middleware('auth');
