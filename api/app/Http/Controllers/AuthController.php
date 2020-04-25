<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use  App\Models\User;

class AuthController extends Controller
{
    /**
     * Criando um novo Usuario.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validando os inputs que veio no $request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

           
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
           
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }
    /**
     *Pega um JWT com as credencias
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validando os inputs que veio no $request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        
        return response()->json(['token'=>$token,'token_type'=>'bearer', 'user'=>Auth::user()]);
        
    }


}


