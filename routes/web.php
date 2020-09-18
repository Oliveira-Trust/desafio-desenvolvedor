<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', 'ClientsController@index')
        ->name('listClients');
Route::get('/clientes/novo', 'ClientsController@create')
    ->name('formCreateClient');
Route::post('/clientes/novo', 'ClientsController@store')
    ->name('storeClient');
Route::get('/clientes/{id}', 'ClientsController@edit')
    ->name('formEditClient');
Route::post('/clientes/{id}', 'ClientsController@update')
    ->name('updateClient');
Route::delete('/clientes/{id}', 'ClientsController@destroy')
    ->name('destroyClient');
