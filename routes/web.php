<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WhatsappController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        
        
        Route::post('/coin-ask/ask', 'App\Http\Controllers\CoinAskController@store')->name('ask-me');
    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
      
    });


    Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
        Route::get('/', 'App\Http\Controllers\WhatsappController@index')->name('index');
        Route::get('/new', 'WhatsappController@new')->name('new');
        Route::post('/store', 'WhatsappController@store')->name('store');
        Route::post('/update', 'WhatsappController@update')->name('update');
        Route::get('/{id}/edit', 'WhatsappController@edit')->name('edit');
        Route::get('/{id}/send', 'WhatsappController@send')->name('send');
        Route::get('/{id}/delete', 'WhatsappController@delete')->name('delete');
    });

    Route::resource('/coins', 'App\Http\Controllers\CoinController');
    //Route::resource('/coin-ask', 'App\Http\Controllers\CoinAskController');
    Route::resource('/campaign-items', 'App\Http\Controllers\CampaignItemController');
    Route::post('/contact/import', 'App\Http\Controllers\ContactController@import')->name('contacts.import');
    Route::get('/contact/clean', 'App\Http\Controllers\ContactController@clean')->name('contacts.clear');

    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::resource('/coin-asks', 'App\Http\Controllers\CoinAskController');
});

