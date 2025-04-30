<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas da web para seu aplicativo.
| Estas rotas são carregadas pelo RouteServiceProvider em um grupo que
| contém o middleware "web". Agora crie algo incrível!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('uploads')->group(function () {
        Route::get('/', [UploadController::class, 'index'])->name('uploads.index');
        Route::get('/novo', [UploadController::class, 'create'])->name('uploads.create');
        Route::post('/', [UploadController::class, 'store'])->name('uploads.store');
        Route::get('/{upload}', [UploadController::class, 'show'])->name('uploads.show');
    });
    
    Route::prefix('dados')->group(function () {
        Route::get('/busca', [DataController::class, 'search'])->name('data.search');
        Route::get('/exportar', [DataController::class, 'export'])->name('data.export');
    });
});