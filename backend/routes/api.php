<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

//Cria um usuario autenticado para teste
Route::post('/tokens/create', [UploadController::class, 'createToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload', [UploadController::class, 'uploadFile']);
    Route::get('/upload', [UploadController::class, 'uploadHistory']);
    Route::get('/search-content', [UploadController::class, 'searchContent']);
});

