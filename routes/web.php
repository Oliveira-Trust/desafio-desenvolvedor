<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\CambioController;

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

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('configuracao', [GeneralController::class, 'settings'])->name('settings');
Route::post('configuracao', [GeneralController::class, 'settingsStore'])->name('settings');
Route::get('historico', [CustomerController::class, 'history'])->name('history');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('cambio', [CambioController::class, 'cambio'])->name('cambio');
Route::get('demostrativo/{cambio_id}', [CambioController::class, 'demostrativo'])->name('demostrativo');