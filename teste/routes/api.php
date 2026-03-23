<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Files\FileController;
use App\Http\Controllers\Files\FileDataController;

Route::prefix('auth')->group(function () {
    Route::post('/create', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/{user}', [AuthController::class, 'show']);
    Route::get('/users', [AuthController::class, 'index']);
});

Route::prefix('docs')->middleware('auth:api')->group(function () {
    Route::post('/save', [FileController::class, 'store']);
    Route::get('/history-files', [FileController::class, 'historyFiles']);
    Route::get('/search-file-data', [FileDataController::class, 'searchFileData']);
});
