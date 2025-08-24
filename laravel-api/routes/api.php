<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AuthController;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Informações do usuário
    Route::get('/user', [AuthController::class, 'userData'])->name('user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Endpoints da aplicação
    Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
    Route::get('/history', [FileUploadController::class, 'history'])->name('history');
    Route::get('/file-contents', [FileUploadController::class, 'fileContents'])->name('file-contents');
});