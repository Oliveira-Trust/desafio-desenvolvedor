<?php

use Illuminate\Support\Facades\Route;
use Presentation\Api\V1\Controllers\{FileController, AuthController};

Route::get('/', function () {
    return response()->json(['message' => 'welcome to file manager api']);
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('files')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [FileController::class, 'storeFile']);
    Route::get('/', [FileController::class, 'getHistory']);
    Route::get('/{filename}', [FileController::class, 'searchContent']);
});
