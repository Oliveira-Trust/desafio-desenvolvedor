<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::post('auth/login', 'AuthController@login');
// Route::post('auth/login-provider', 'AuthController@loginProvider');
Route::post('auth/register', 'AuthController@customRegistration');
Route::get('users', 'UserController@index');
// Route::post('auth/reset-password', 'AuthController@resetPassword');

// Route::middleware(['jwt.auth'])->group(function () {
//     Route::get('auth/me', 'AuthController@me'); 
//     Route::get('auth/logout', 'AuthController@logout'); 
//     Route::post('auth/refresh', 'AuthController@refresh'); 
//     Route::post('auth/refresh_token', function(){
//         try {
//             $token = JWTAuth::parseToken()->refresh();
//             return response()->json(compact('token'));
//         }catch (JWTException $exception){
//             return response()->json(['error' => 'token_invalid'],400);
//         }
//     });

//     Route::post('/user-store', 'UserController@store')->name('usuarios.store');
    
// });
