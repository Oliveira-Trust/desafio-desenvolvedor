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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix("auth")->group(function () {
    Route::post('login', 'AuthController@login');
    Route::get('verify', 'AuthController@verify')->middleware(["authAPI"]);
    Route::post('logout', 'AuthController@logout')->middleware(["authAPI"]);
});

Route::prefix("users")->middleware(["authAPI"])->group(function () {
    Route::get('/all','UserController@index');
});

Route::prefix("operation")->middleware(["authAPI"])->group(function () {
    Route::post('convert-currency', 'OperationController@postConvertCurrency');
    Route::get('list-operations/{user_id}', 'OperationController@getListOperations');
});

Route::prefix("coin")->middleware(["authAPI"])->group(function () {
    Route::get('list-coins', 'CoinController@getListCoins');
});

Route::prefix("payment")->middleware(["authAPI"])->group(function () {
    Route::get('list-form-payment', 'PaymentController@getListFormPayment');
});
