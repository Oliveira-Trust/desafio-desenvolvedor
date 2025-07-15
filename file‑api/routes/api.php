<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('/upload', [UploadController::class, 'store'])->name('uploads.store');

Route::get('/uploads', [UploadController::class, 'index'])->name('uploads.index');

Route::get('/search', [RecordController::class, 'index'])->name('records.search');