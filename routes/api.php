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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', 'Api\\LoginController@register');
Route::post('login', 'Api\\LoginController@login');

Route::prefix('user')->group(function (){

    Route::get('me', 'Api\\UserController@me');
    Route::put('me', 'Api\\UserController@meUpdate');
    Route::delete('me', 'Api\\UserController@meDelete');

});
Route::resource('user', 'Api\\UserController');


Route::resource('product', 'Api\\ProductController');
Route::delete('/product/{id}/photo', 'Api\\ProductController@destroyImage')->name('product.delphoto');
Route::get('/products', 'Api\\ProductController@showAll')->name('product.products');

//Route::post('order/', 'Api\\OrderController@index');
//Route::post('order/finally', 'Api\\OrderController@finallyOrder');
//Route::get('order/{id}', 'Api\\OrderController@show');
//Route::get('order/{id}', 'Api\\OrderController@cancel');
//Route::get('order/{id}', 'Api\\OrderController@aproved');
//Route::get('orders', 'Api\\OrderController@ordersAll');
