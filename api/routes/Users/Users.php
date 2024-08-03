<?php

namespace Routes\Users;

use App\Http\Controllers\Users\CreateUserController;
use App\Http\Controllers\Users\ListUserController;
use App\Http\Controllers\Users\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::post('api/user/create', [CreateUserController::class, '__invoke']);
Route::put('api/user/update', [UpdateUserController::class, '__invoke']);
Route::get('api/user/list', [ListUserController::class, '__invoke']);