<?php

use App\FileUpload\Http\Controllers\FileUploadController;
use App\Instrument\Http\Controllers\InstrumentController;
use App\User\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::get('me', [UserAuthController::class, 'me']);
    Route::post('logout', [UserAuthController::class, 'logout']);

    Route::post('/files/upload', [FileUploadController::class, 'store']);
    Route::get('/files/history', [FileUploadController::class, 'index']);
    Route::get('/files/history/{id}', [FileUploadController::class, 'show']);

    Route::get('/instruments', [InstrumentController::class, 'index']);
});
