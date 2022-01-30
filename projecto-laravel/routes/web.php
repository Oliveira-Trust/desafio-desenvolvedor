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

Route::get('test', function() {
    $client = new GuzzleHttp\Client();
    $res = $client->get('https://economia.awesomeapi.com.br/json/BRL-USD');

    return $res->getBody();
    echo $res->getStatusCode(); // 200
    echo $res->getBody();
})->middleware('xss-filter');
