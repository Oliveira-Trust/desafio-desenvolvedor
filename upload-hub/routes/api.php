<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportFileController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\ImporteDataFileSearchController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {
    Route::get('/uploads/history', [UploadFileController::class, 'history']);
    Route::post('/uploads', [UploadFileController::class, 'upload']);
    
    Route::get('/search', [ImporteDataFileSearchController::class, 'search']);
});



Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});
