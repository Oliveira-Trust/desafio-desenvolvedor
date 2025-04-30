<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UploadController;
use App\Http\Controllers\API\V1\UploadHistoryController;
use App\Http\Controllers\API\V1\DataSearchController;
use App\Http\Controllers\API\V1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::prefix('v1')->group(function () {
        Route::post('/upload', [UploadController::class, 'store']);
        
        Route::get('/uploads', [UploadHistoryController::class, 'index']);
        Route::get('/uploads/{id}', [UploadHistoryController::class, 'show']);
        
        Route::get('/data', [DataSearchController::class, 'search']);
    });
});
