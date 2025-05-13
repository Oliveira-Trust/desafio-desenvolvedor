<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::post('/upload', [UploadController::class, 'upload']);
Route::get('/history', [UploadController::class, 'history']);
Route::get('/search', [UploadController::class, 'search']);