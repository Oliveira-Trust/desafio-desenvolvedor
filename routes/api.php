<?php

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
Route::get('/', function(){
    return retorno(null, 200, 'Connected');
});
Route::get('login', 'Api\Auth\JwtController@login');
// Route::middleware(['api'])->group(function($router){
Route::middleware(['apiJwt'])->group(function(){
    Route::post('logout', 'Api\Auth\JwtController@logout');
    Route::post('refresh', 'Api\Auth\JwtController@refresh');
    Route::post('autenticado', 'Api\Auth\JwtController@me');
    Route::get('contas', 'Api\ContasController@index');
});