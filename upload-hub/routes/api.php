<?php

use App\Http\Controllers\ImportFileController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {
    Route::get('/uploads/history', [UploadFileController::class, 'history']);
    Route::post('/uploads', [UploadFileController::class, 'upload']);
});



Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});

Route::get('/test', [ImportFileController::class, 'teste']);