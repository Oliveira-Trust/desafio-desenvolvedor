<?php

use Illuminate\Support\Facades\Mail;

use App\Mail\EnviaCotacao;

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
    return redirect('/currency');
});

Route::get('currency','CalcularMoeda@index');

Route::post('currency','CalcularMoeda@calcular');
  
