<?php

use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group( function() {
    Route::get('/', 'index')->middleware(['auth'])->name('home');
});

Route::group(['middleware' => 'refresh-token-api'],function() {
    Auth::routes();
});
