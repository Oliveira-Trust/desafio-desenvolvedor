<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ValidatorsHelper;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    use ValidatorsHelper;

    public function authenticate(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('Auth')->plainTextToken;
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'Login efetuado com sucesso');
        } else {
            return $this->sendError('Email e/ou senha incorretos', 401);
        }
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = $request->all();
            $this->validateUserRegister($input);
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('Auth')->plainTextToken;
            $success['name'] =  $user->name;
       
            return $this->sendResponse($success, 'Usuário criado com sucesso');
        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro no cadastro de usuário');
        }
    }

    public function revokeUserTokens(): \Illuminate\Http\JsonResponse
    {   
        try {
            $user = Auth::user();
            if ($user) {
                $user->tokens()->delete();
                return $this->sendResponse([], 'Usuário deslogado com sucesso');
            }

            return $this->sendResponse([], 'Não existe sessão ativa');

        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao deslogar usuário');
        }
    }
}
