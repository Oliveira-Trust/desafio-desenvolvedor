<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::post('/upload', [UploadController::class, 'uploadFile']);
Route::get('/upload/history', [UploadController::class, 'getUploadHistory']);
Route::get('/search/{id}', [UploadController::class, 'searchFileContent']);