<?php

use Illuminate\Support\Facades\Route;
use Presentation\Api\Controllers\FileController;

Route::get('/', function () {
    return response()->json(['message' => 'welcome to file manager api']);
});

Route::prefix('files')->group(function () {
    Route::post('/', [FileController::class, 'storeFile']);
});
