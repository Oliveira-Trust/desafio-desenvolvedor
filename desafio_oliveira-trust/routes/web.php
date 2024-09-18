<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');

Route::get('/history', function () {
    return view('upload');
});

Route::get('/query', function () {
    return view('upload');
});