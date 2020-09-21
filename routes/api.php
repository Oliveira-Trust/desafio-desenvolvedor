<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['prefix' => 'clients'], function() {
//    Route::get('', [ClientController::class,'index'])->name('clients.index');
//    Route::post('', [ClientController::class,'store'])->name("clients.store");
//    Route::patch('{client}', [ClientController::class,'update'])->name("clients.update");
//    Route::delete('{client}', [ClientController::class,'destroy'])->name("clients.destroy");
//});

//Route::group(['prefix' => 'products'], function() {
//    Route::post('', [ProductController::class,'store'])->name("products.store");
//    Route::patch('{product}', [ProductController::class,'update'])->name("products.update");
//    Route::delete('{product}', [ProductController::class,'destroy'])->name("products.destroy");
//});

Route::group(['prefix' => 'orders'], function() {
    //Route::get('', [OrderController::class,'index'])->name('orders.index');
    Route::post('', [OrderController::class,'store']);
    //Route::patch('{order}', [OrderController::class,'update'])->name("orders.update");
    //Route::delete('{order}', [OrderController::class,'destroy'])->name("orders.destroy");
});
