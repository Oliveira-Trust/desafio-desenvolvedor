<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotacaoPrecoController;
use App\Http\Controllers\TaxasConversaoController;

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
    return redirect('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('cotacao-preco', [CotacaoPrecoController::class, 'index'])->name('cotacao-preco.index');
Route::post('cotacao-preco/converte', [CotacaoPrecoController::class, 'save'])->name('cotacao-preco.converte');

Route::resource('conversao-taxa', TaxasConversaoController::class);
