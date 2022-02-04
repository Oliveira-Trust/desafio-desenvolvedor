<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $user = Auth::user();
            $success['token'] =  $user->createToken('authToken')->accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.', ['error' => false]);
        } else {
            return $this->sendResponse('Unauthorised.', ['error' => true]);
        }
    }
}
