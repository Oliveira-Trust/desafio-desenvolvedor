<?php

namespace Routes\Config;

use App\Http\Controllers\Config\EditConfigController;
use App\Http\Controllers\Config\GetConfigDataController;
use Illuminate\Support\Facades\Route;

Route::put('api/config/edit-config', [EditConfigController::class, '__invoke']);
Route::get('api/config/get-data', [GetConfigDataController::class, '__invoke']);