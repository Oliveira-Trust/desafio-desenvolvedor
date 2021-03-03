<?php

Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@home');
Route::get( '/pedidos', 'HomeController@pedidos' );
Route::get( '/editarproduto', 'HomeController@editarproduto' );
Route::get( '/carrinho', 'HomeController@carrinho' );
Route::get( '/usuarios', 'HomeController@usuarios' );
Route::get( '/newproduct', 'HomeController@newproduct' );
Route::post( '/criarproduto', 'HomeController@criarproduto' );
Route::get( '/addCarrinho', 'HomeController@addCarrinho' );
Route::get( '/remover', 'HomeController@remover' );
Route::get( '/finalizar', 'HomeController@finalizar' );
Route::get( '/tratar', 'HomeController@tratar' );
Route::get( '/detalhes', 'HomeController@detalhes' );
Route::get( '/ativar', 'HomeController@ativar' );
Route::get( '/desativar', 'HomeController@desativar' );
Route::post( '/atualizar', 'HomeController@atualizar' );
Route::get( '/tratapedido', 'HomeController@tratapedido' );
Route::get( '/edituser', 'HomeController@edituser' );
Route::post( '/massivo', 'HomeController@massivo' );

Auth::routes();

