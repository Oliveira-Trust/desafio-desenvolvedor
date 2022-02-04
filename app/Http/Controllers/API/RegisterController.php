<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{
    /**
     * Register raw on api
     * it can return name and token to interactor vie e.g. via postman
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $resp = User::where('email', $request->email)->get();
        if (count($resp) > 0) return $this->sendResponse($resp, 'Already it account!!');

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $success['name'] =  $user->name;
        $success['access_token'] =  $user->createToken('authToken')->accessToken;
        return $this->sendResponse($success, [
            'info' =>
            'User register successfully.',
            'successful' =>
            true
        ]);
    }
}
