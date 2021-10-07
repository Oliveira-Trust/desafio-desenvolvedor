<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    protected function sendResetLinkResponse(Request $request, $response)
    {
        $response = ['message' => "Email de redefinição de senha enviado"];
        return response($response, 200);
    }
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $response = "Não foi possível enviar o e-mail para este endereço de e-mail";
        return response($response, 500);
    }
}
