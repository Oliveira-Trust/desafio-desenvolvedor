<?php

use App\Http\Controllers\Api\ConversionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.'], function() {
    Route::post('conversion', [ConversionController::class, 'run'])->name('conversion.run');
});
