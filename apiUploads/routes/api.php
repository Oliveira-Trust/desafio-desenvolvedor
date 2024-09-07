<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::post('/upload', [UploadController::class, 'upload']);
Route::get('/history', [UploadController::class, 'history']);
Route::get('/searchContentFile', [UploadController::class, 'searchContentFile']);
Route::get('/uploadTeste', [UploadController::class, 'uploadTeste']);