<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\InstrumentsController;
use App\Http\Controllers\Api\v1\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:sanctum')->prefix('/v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->prefix('/v1')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/upload', [UploadController::class, 'store'])->name('uploads.upload');
    Route::get('/uploads', [UploadController::class, 'index'])->name('uploads.index');
    Route::get('/instruments', [InstrumentsController::class, 'index'])->name('instruments.index');
});