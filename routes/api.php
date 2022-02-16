<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'moedas'], function () {
    Route::get('combinacoes', 'MoedasController@combinacoes');
});
Route::resource('moedas', 'MoedasController');
Route::post('converter', 'CambioController@converter');