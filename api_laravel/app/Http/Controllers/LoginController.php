<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index() 
    {
        return view('app.login');
    }


    public function authenticate(Request $request) 
    {
       
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->withErrors('O email informado não é válido');
        }

        $email = $request->get('email');
        $password = $request->get('senha');
        

        $user = new User;
        $userIsAuthorized = $user->where('email', '=', $email)->where('password', '=', $password)->get()->first(); 
        
        if (isset($userIsAuthorized->name)) {
            session_start();

            $_SESSION['nome'] = $userIsAuthorized->name;            
            $_SESSION['email'] = $userIsAuthorized->email;

            return view('app.admin', ['name' =>  $_SESSION['nome']]);
        } 
            
        return redirect()->route('app.login', ['erro' => 1]);
    }
}
