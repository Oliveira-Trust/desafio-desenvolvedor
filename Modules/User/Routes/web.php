<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\ProfileController;
use Modules\User\Http\Controllers\PasswordController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
