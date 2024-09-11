<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('upload', [UploadController::class, 'index']);
Route::post('upload', [UploadController::class, 'upload']);
Route::get('upload-history', [UploadController::class, 'history']);
Route::get('search-file', [UploadController::class, 'search']);


