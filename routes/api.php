<?php

use Illuminate\Http\Request;

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

//endPoint de clientes
Route::get('clientes', function() {
    return \App\Models\Client::all();
});
Route::get('clientes/{id}', function($id) {
    return \App\Models\Client::find($id);
});
Route::post('clientes', function(Request $request) {
    return \App\Models\Client::create($request->all);
});
Route::put('clientes/{id}', function(Request $request, $id) {
    $clientes = \App\Models\Client::findOrFail($id);
    $clientes->update($request->all());

    return $clientes;
});

Route::delete('clientes/{id}', function($id) {
    \App\Models\Client::find($id)->delete();
    return 204;
});

//endPoint de produtos
Route::get('produtos', function() {
    return \App\Models\Products::all();
});
Route::get('produtos/{id}', function($id) {
    return \App\Models\Products::find($id);
});
Route::post('produtos', function(Request $request) {
    return \App\Models\Products::create($request->all);
});
Route::put('produtos/{id}', function(Request $request, $id) {
    $produtos = \App\Models\Products::findOrFail($id);
    $produtos->update($request->all());
    return $produtos;
});
Route::delete('produtos/{id}', function($id) {
    \App\Models\Products::find($id)->delete();
    return 204;
});

//endPoint de produtos
Route::get('pedidos', function() {
    return \App\Models\Order::all();
});
Route::get('pedidos/{id}', function($id) {
    return \App\Models\Order::find($id);
});
Route::post('pedidos', function(Request $request) {
    return \App\Models\Order::create($request->all);
});
Route::put('pedidos/{id}', function(Request $request, $id) {
    $pedidos = \App\Models\Order::findOrFail($id);
    $pedidos->update($request->all());
    return $pedidos;
});
Route::delete('produtos/{id}', function($id) {
    \App\Models\Order::find($id)->delete();
    return 204;
});
