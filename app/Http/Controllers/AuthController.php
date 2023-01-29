<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $result;

    public function __construct()
    {
        $this->result = ['error' => ''];
    }

    public function userRegister(Request $request)
    {
        // Inputs validator
        $validator = Validator::make($request->only('name', 'email', 'password'), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20',
        ]);

        if ($validator->fails()) {
            $this->result['error'] = $validator->errors();
            return $this->result;
        }

        $this->newUser($request);

        return $this->userLogin($request);
    }

    public function userLogin(Request $request)
    {
        $creds = $request->only('email', 'password');

        // Check authetication
        if (!Auth::attempt($creds)) {
            $this->result['error'] = __('auth.failed');
            return $this->result;
        }

        // Get user
        $user = User::where('email', $creds['email'])->first();

        // Remove previous tokens
        $user->tokens()->delete();

        // Create new user token
        $token = $user->createToken($user->email)->plainTextToken;

        // Return token
        $this->result['token'] = $token;

        return $this->result;
    }

    public function userLogout(Request $request)
    {
        // Get user
        $user = $request->user();

        // Remove user tokens
        $user->tokens()->delete();

        return $this->result;
    }

    private function newUser(Request $request)
    {
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = password_hash($request->password, PASSWORD_DEFAULT);
        $newUser->save();
    }

    public function user(Request $request)
    {
        return $this->result['user'] = $request->user();
    }

}
