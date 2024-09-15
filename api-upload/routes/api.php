<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Auth;

// Rotas protegidas pelo middleware auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload', [FileUploadController::class, 'upload']);
    Route::get('/history', [FileUploadController::class, 'history']);
    Route::get('/search', [FileUploadController::class, 'search']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Login da API com token
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials) === false) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('token');

    return response()->json(['token' => $token->plainTextToken]);
});
