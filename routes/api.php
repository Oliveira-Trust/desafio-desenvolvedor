<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\InstrumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    Route::get('files', [FileUploadController::class, 'history']);
    Route::get('files/{id}', [FileUploadController::class, 'show']);
    Route::post('files', [FileUploadController::class, 'upload']);

    Route::get('instruments', [InstrumentController::class, 'index']);
});
