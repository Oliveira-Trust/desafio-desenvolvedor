<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/upload', [UploadController::class, 'uploadFile']);
Route::get('/upload/historico', [UploadController::class, 'uploadHistorico']);
Route::get('/upload/busca', [UploadController::class, 'buscaArquivoConteudo']);