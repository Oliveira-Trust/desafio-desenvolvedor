<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens;
    /**
     *Registrar um novo usuário
     */
    public function registerUser(Request $request){
        $request->validate([

            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'token_name' => 'required|string',

        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken($request->token_name)->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response,201);
    }

    /**
     * Realizar autentação de usuário
     */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'token_name' => 'required|string',
        ]);

        // Validar email do usuário
        $user = User::where('email', $request->email)->first(); 
        // Validar password do usuário e email
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Credenciais Inválidas!'                
            ]);
        }

        $token = $user->createToken($request->token_name)->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response,201);
    }   

    /**
     * Logout do usuário
     */
    public function logout(){
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();    
        return [
            'message' => 'Logout concluído - exclusão dos tokens'
        ];
    }
    
}
