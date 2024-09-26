<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login;
use App\Http\Requests\Registro;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

class AutenticacaoController extends Controller
{

    public function __construct(private UsuarioService $usuarioService)
    {
        
    }

    public function registro(Registro $request): JsonResponse
     {
            return response()->json($this->usuarioService->registrar($request));
     }

     public function login(Login $login): JsonResponse
     {
          $token = $this->usuarioService->token($login); 
          return response()->json(['token' => $token]);
     }
}
