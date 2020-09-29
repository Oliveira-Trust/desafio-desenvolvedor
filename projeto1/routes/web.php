<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PagamentoController;

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

Route::get("contato",[ContatoController::class,'index']);

//Produtos

Route::resource('produtos', ProdutosController::class);
Route::get("produtos",[ProdutosController::class,'index']);
Route::get('produtos/create', [ProdutosController::class, 'create']);
Route::get('produtos/{id}', [ProdutosController::class, 'show']);
Route::post('produtos/busca',[ProdutosController::class, 'busca']);


Route::get('add-carrinho/{id}',[ProdutosController::class, 'addCarinho']);
Route::get('ex-carrinho/{id}',[ProdutosController::class, 'excluir']);

Route::get('carrinho',[ProdutosController::class, 'carrinho']);

Route::Match(['get', 'post'],'checkout',[ProdutosController::class, 'getCheckout']);

Route::post("pagamento",[PagamentoController::class, 'store']);

//Route::post("checkout",[PagamentoController::class, 'index']);
Route::post("teste/{total}",[PagamentoController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
