<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::post('/file-upload', [FileUploadController::class, 'fileUpload'])
    ->name('file.upload');


Route::get('/file-upload-data', [FileUploadController::class, 'fileUploadData'])
    ->name('file.upload.data');


Route::get('/find-file', [FileUploadController::class, 'findFile'])
    ->name('file.find');


Route::get('/search-files', [FileUploadController::class, 'searchFiles'])
    ->name('file.search');
