<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CotacaoController;

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
    return view('index');
});

//Route::get('index', [CotacaoController::class,'index']);
Route::get('/valorCotacao', [ApiController::class,'getValorCotacao']);
Route::get('/testeCotacao', [CotacaoController::class,'verificaCotacao']);
Route::post('/cotacao', [CotacaoController::class,'salvaConversao']);