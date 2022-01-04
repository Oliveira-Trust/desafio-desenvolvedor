<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HistoryCurrencyConversion;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
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

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

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

        // response
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

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * History
     */
    public function setHistory(Request $request)
    {
        try {

            $user = Auth::user();

            $success = HistoryCurrencyConversion::create([
                'moeda_origin' => $request->moeda_origin,
                'moeda_destino' => $request->moeda_destino,
                'forma_pagamento' => $request->forma_pagamento,
                'taxa_pagamento' => $request->taxa_pagamento,
                'taxa_conversao' => $request->taxa_conversao,
                'valor_conversao' => $request->valor_conversao,
                'valor_sem_taxa' => $request->valor_sem_taxa,
                'user_id' => $user->id
            ]);

            $message = 'Usuário registrado com sucesso!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * GetHistory
     */
    public function getHistory()
    {
        try {
            $user = Auth::user();

            $message = HistoryCurrencyConversion::where('user_id',  $user->id)->orderBy('id','desc')->get();
            $success = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
