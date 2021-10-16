<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Awesome\{AvaliableController};


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::prefix('converter')->group(function () {
    Route::get('avaliable',[AvaliableController::class, 'index']);
});
 */
