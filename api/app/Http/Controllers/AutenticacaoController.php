<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Registro;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacaoController extends Controller
{

    public function __construct(private UsuarioService $usuarioService)
    {
        
    }
     public function registro(Registro $request)
     {
            return response()->json($this->usuarioService->registrar($request));
     }

     public function login(Login $login) {
          return response()->json($this->usuarioService->token($login));
     }

     public function logout(Request $login) {
          Auth::logout();
          $login->user()->currentAccessToken()->delete();
           return response()->json(['message' => 'Sessão foi finalizada']);
     }

}
