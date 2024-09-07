<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/file-upload', [FileUploadController::class, 'fileUpload']);
Route::get('/file-upload-data', [FileUploadController::class, 'fileUploadData']);
Route::get('/find-file', [FileUploadController::class, 'findFile'])->name('file.find');
Route::get('/search-files', [FileUploadController::class, 'searchFiles']);
