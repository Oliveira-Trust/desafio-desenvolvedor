<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('login', [AuthController::class, 'login']);

// AUTENTICADO
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('upload', [FileController::class, 'upload']);
    Route::get('upload-history', [FileController::class, 'uploadHistory']);
    Route::get('search-content', [FileController::class, 'searchContent']);
});
// AUTENTICADO FIM
