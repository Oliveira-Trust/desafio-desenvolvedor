<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\UploadHistoryController;
use App\Http\Controllers\GetFileController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// 1) Upload de arquivo
Route::post('/uploads', [UploadController::class, 'store']);

// 2) Histórico de uploads
Route::get('/uploads', [UploadHistoryController::class, 'index']);

// 3) Buscar conteúdo do arquivo (TckrSymb e RptDt) + paginação quando não houver filtros
Route::get('/files', [GetFileController::class, 'index']);
