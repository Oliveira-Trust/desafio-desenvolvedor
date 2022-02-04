<?php

use App\Http\Controllers\API\PeoplesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AllExchange;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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

Route::get('test', [TestController::class, 'index']);

Route::get('list', [AllExchange::class, 'TODO']);
Route::get('/exchange', function () {
    return view('trade');
});

Route::get('/showProviders', function () {
    dd(app());
});

Route::get('/guzzle', function (Request $request) {
    $res = Http::get('https://economia.awesomeapi.com.br/json/all');
    return $res->json();
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/send-mail', [MailController::class, 'sendEmail']);
