<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FilesController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\HistoryFilesController;
use App\Http\Controllers\Api\SearchFilesController;

Route::post('/files', [FilesController::class, 'files']);






