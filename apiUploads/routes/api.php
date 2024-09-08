<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\EnsureTokenIsValid;

Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::post('/upload', [UploadController::class, 'upload']);
    Route::get('/history', [UploadController::class, 'history']);
    Route::get('/searchContentFile', [UploadController::class, 'searchContentFile']);
});

Route::get('/generateToken', [AuthController::class, 'generateToken']);

