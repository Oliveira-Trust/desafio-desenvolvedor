<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
        protected function resetPassword($usuario, $password)
    {
        $usuario->password = Hash::make($password);
        $usuario->save();
        event(new PasswordReset($usuario));
    }
    protected function sendResetResponse(Request $request, $response)
    {
        $response = ['message' => "Senha redefinida com sucesso"];
        return response($response, 200);
    }
    protected function sendResetFailedResponse(Request $request, $response)
    {
        $response = "Token inválido";
        return response($response, 401);
    }
}
