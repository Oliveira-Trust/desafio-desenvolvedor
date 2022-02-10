<?php

use App\Http\Controllers\Web\ConversionController;
use Illuminate\Support\Facades\Route;

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
Route::group(['as' => 'web.'], function() {
    Route::get('apps/currency-conversion', [ConversionController::class, 'index'])->name('conversion.index');
});
