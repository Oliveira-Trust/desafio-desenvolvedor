<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\EnsureTokenIsValid;

Route::post('/upload', [UploadController::class, 'upload'])->middleware([EnsureTokenIsValid::class]);
Route::get('/history', [UploadController::class, 'history'])->middleware([EnsureTokenIsValid::class]);
Route::get('/searchContentFile', [UploadController::class, 'searchContentFile'])->middleware([EnsureTokenIsValid::class]);

