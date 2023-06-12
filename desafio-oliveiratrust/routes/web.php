<?php

use App\Http\Controllers\CotationController;
use App\Http\Controllers\SettingController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\CotationController::class, 'index'])->name('home');
    Route::resource('cotations', CotationController::class);
    Route::post('/cotations/sendEmail/{id}', [App\Http\Controllers\CotationController::class, 'sendEmail'])->name('send_email');
    Route::resource('settings', SettingController::class);
});
