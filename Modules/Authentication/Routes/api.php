<?php

use Modules\Authentication\Http\Controllers\{ForgotPasswordController, ResetPasswordController, SessionController};

Route::prefix('auth')->middleware('guest:api')->group(function () {
    Route::post('/login', [SessionController::class, 'login']);
    Route::post('/register', [SessionController::class, 'register']);
    Route::post('/forgot', [ForgotPasswordController::class, 'forgot']);
    Route::get('/reset/{token}/{email}', [ResetPasswordController::class, 'formReset'])->name('password.reset');
    Route::post('/reset', [ResetPasswordController::class, 'reset']);
});







