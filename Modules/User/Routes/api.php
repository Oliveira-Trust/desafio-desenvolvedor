<?php

use Modules\Authentication\Http\Controllers\SessionController;

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [SessionController::class, 'profile']);
    Route::get('/logout', [SessionController::class, 'logout']);
});

