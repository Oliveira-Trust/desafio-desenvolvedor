<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller implements UserRepositoryInterface
{

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'Usuário logado com sucesso!';
        } else {
            $success = false;
            $message = 'E-mail/Senha não existe, por favor registrar';
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Register
     */
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'Usuário registrado com sucesso!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = '';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

}
