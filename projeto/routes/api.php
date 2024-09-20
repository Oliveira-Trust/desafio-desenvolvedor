<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('arquivo')->controller(ApiController::class)->group(function () {
    Route::post('', 'upload')->name('api.upload');
    Route::get('lista', 'arquivos')->name('api.arquivos');
    Route::get('conteudo/{id}', 'conteudo')->name('api.conteudo');
    Route::get('historico', 'historico')->name('api.historico');
})->middleware('api');
