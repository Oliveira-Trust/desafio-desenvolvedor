<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\QuoteController;
use App\Http\Controllers\Web\Auth\LoginController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [QuoteController::class, 'getQuotesByPeriod']);

    Route::prefix('/cotacoes')->group(function () {
        Route::get('/', [QuoteController::class, 'formQuote']);
        Route::get('/historico', [QuoteController::class, 'getQuotes']);

        Route::post('/', [QuoteController::class, 'quote']);
        Route::post('/email/enviar/{quote}', [QuoteController::class, 'sendMail']);
    });
});
