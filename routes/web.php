<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrencyController;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ Controller::class, 'index' ])->middleware(RedirectIfAuthenticated::class);
Route::post('/register', [ Controller::class, 'register' ]);
Route::post('/login', [ Controller::class, 'login' ]);
Route::get('/logout', [ Controller::class, 'logout' ]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [ UserController::class, 'home' ]);
    Route::post('/get_exchange_rate/{currencyExchange}', [ UserController::class, 'getLastExchangeRate' ]);
    Route::get('/get_history', [ UserController::class, 'getExchangeHistory' ]);
    Route::delete('/delete_history', [ UserController::class, 'deleteExchangeHistory' ]);
});
