<?php

use App\Http\Controllers\UserHistoryController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
    // ROTA DESTINADA AO HISTÓRICO
    Route::get('/historico', [UserHistoryController::class, 'index'])->name('user-history.index');

});
require __DIR__.'/auth.php';
