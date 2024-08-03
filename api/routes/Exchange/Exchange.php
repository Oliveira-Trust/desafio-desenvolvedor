<?php

namespace Routes\Exchange;

use App\Http\Controllers\Exchange\FetchDataController;
use App\Http\Controllers\Exchange\GetExchangeUserController;
use Illuminate\Support\Facades\Route;

Route::get('api/exchange/fetch-data', [FetchDataController::class, '__invoke']);
Route::get('api/exchange/get-exchange-user', [GetExchangeUserController::class, '__invoke']);