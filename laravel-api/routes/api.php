<?php

use App\FileUpload\Http\Controllers\FileUploadController;
use App\Instrument\Http\Controllers\InstrumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/files/upload', [FileUploadController::class, 'store']);
Route::get('/files/history', [FileUploadController::class, 'index']);
Route::get('/files/history/{id}', [FileUploadController::class, 'show']);

Route::get('/instruments', [InstrumentController::class, 'index']);
