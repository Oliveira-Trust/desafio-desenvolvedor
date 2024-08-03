<?php

namespace Routes\Auth;

use App\Http\Controllers\Auth\CheckTokenController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('api/auth/login', [LoginController::class, '__invoke']);
Route::get('api/auth/check', [CheckTokenController::class, '__invoke']);