<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/upload', [FileUploadController::class, 'store']);


Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});