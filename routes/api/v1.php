<?php

use Illuminate\Support\Facades\Route;
use Presentation\Api\V1\Controllers\FileController;

Route::get('/', function () {
    return response()->json(['message' => 'welcome to file manager api']);
});

Route::prefix('files')->group(function () {
    Route::post('/', [FileController::class, 'storeFile']);
    Route::get('/', [FileController::class, 'getHistory']);
});
