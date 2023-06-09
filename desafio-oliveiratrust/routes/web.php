<?php

use App\Http\Controllers\CotationController;
use Illuminate\Support\Facades\Auth;
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


Route::post('/toggle-theme', function (Illuminate\Http\Request $request) {
    if ($request->session()->get('theme') == 'dark') {
        $request->session()->put('theme', 'light');
    } else {
        $request->session()->put('theme', 'dark');
    }

    return response()->json(['status' => 'success']);
});


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::middleware(['auth'])->group(function () {
//     // Route::post('/cotations', [CotationController::class, 'store'])->name('cotations.add');
    
// });

Route::middleware(['auth'])->group(function () {
    Route::resource('cotations', CotationController::class);
});