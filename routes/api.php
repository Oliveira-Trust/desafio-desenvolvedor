<?php

use Illuminate\Support\Facades\Route;

Route::resource('/clientes', 'Api\ClienteController');
Route::resource('/produtos', 'Api\ProdutoController');
Route::resource('/pedidos', 'Api\PedidoController');
