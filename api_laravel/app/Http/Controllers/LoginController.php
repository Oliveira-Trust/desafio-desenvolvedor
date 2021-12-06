<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index() 
    {
        return view('app.login');
    }

    public function authenticate(Request $request) 
    {
    
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

            return redirect()->back()->withErrors(['errors' =>'O email informado não é válido ']);
        }

        $email = $request->get('email');
        $password = $request->get('senha');
        
        $user = new User;    
        $userIsAuthorized = $user->where('email', '=', $email)->get()->first();

        $hashed = Hash::make($password); 
 
        if (Hash::check($password, $hashed)) {
            session_start();

            session( ['id' => $userIsAuthorized->id] );
            session( ['name' => $userIsAuthorized->name] );
            session( ['email' => $userIsAuthorized->email] );

            return  redirect()->route('app.admin');

        }
        
        return redirect()->back()->withErrors(['errors' =>'Login ou senha inválida ']);
    }

    public function logout() 
    {
        if (!empty(session()->all())) {
            session()->pull('id', []);
            session()->pull('name', []);
            
            return redirect()->route('app.login');
        }
    }
}
