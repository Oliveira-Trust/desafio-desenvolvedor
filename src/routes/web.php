<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\HealthCheckController;

// Welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Route to display the currency conversion form
Route::get('/currency-conversion', [CurrencyConversionController::class, 'index'])->name('currency.index');

// Route to process the currency conversion form (POST method)
Route::post('/currency-conversion', [CurrencyConversionController::class, 'convert'])->name('currency.convert');

// Login page display route
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

// Login form processing route
Route::post('/login', 'Auth\LoginController@login');

// Registration page display route
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// Registration form processing route
Route::post('/register', 'Auth\RegisterController@register');

// Route for displaying quotations (protected by authentication middleware)
Route::middleware('auth')->get('/quotations', 'QuotationController@index');

// Route for displaying the dashboard after login (protected by authentication middleware)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Health check route (accessible to all, does not require authentication)
Route::get('/health', [HealthCheckController::class, 'index']);

// Laravel default authentication routes
Auth::routes();

// Duplicate route for the dashboard after login (previously defined above)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
