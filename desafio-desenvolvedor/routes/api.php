<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\InstrumentController;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Credenciais inválidas.'
        ], 401);
    }

    // limpa tokens antigos aqui
    $token = $user->tokens()->delete();
    $token = $user->createToken('token-desafio')->plainTextToken;

    return response()->json([
        'message' => 'Login realizado com sucesso.',
        'token' => $token
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload', [FileController::class, 'upload']);
    Route::get('/history', [FileController::class, 'history']);
    Route::get('/instruments', [InstrumentController::class, 'index']);
});
