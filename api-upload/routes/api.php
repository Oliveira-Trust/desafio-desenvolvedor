<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload', [FileUploadController::class, 'upload']);
    Route::get('/history', [FileUploadController::class, 'history']);
    Route::get('/search', [FileUploadController::class, 'search']);
});
