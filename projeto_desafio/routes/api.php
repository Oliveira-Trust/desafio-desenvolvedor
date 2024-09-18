<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/token', [AuthController::class, 'token']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/upload', [FileController::class, 'upload']);
    Route::get('/history', [FileController::class, 'history']);
    Route::get('/search', [FileController::class, 'search']);
});