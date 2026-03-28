<?php

use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('/upload', [UploadController::class, 'store']);
Route::get('/uploads', [UploadController::class, 'index']);
Route::get('/instruments', [InstrumentController::class, 'index']);
