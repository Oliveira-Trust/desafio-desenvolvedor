<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use JWTAuthException;
use App\Http\Requests\UserValidation;

class AuthController extends Controller
{
  private function getToken($email, $password)
  {
    $token = null;
    //$credentials = $request->only('email', 'password');
    try {
      if (!$token = JWTAuth::attempt( ['email'=>$email, 'password'=>$password])) {
        return response()->json([
          'response' => 'error',
          'message' => 'Password or email is invalid',
          'token'=>$token
        ]);
      }
    } catch (JWTAuthException $e) {
      return response()->json([
        'response' => 'error',
        'message' => 'Token creation failed',
      ]);
    }
    return $token;
  }
  
  public function login(Request $request)
  {
    $user = User::where('email', $request->email)->get()->first();
    if ($user && \Hash::check($request->password, $user->password)) // The passwords match...
    {
        $token = self::getToken($request->email, $request->password);
        $user->auth_token = $token;
        $user->save();
        $response = [
            'success'=>true, 
            'data'=>[
                'id'=>$user->id,
                'auth_token'=>$user->auth_token,
                'name'=>$user->name, 
                'email'=>$user->email
            ]
        ];
        return response()->json($response, 200);
    } else {
        $response = ['success'=>false, 'data'=>[], 'message'=>'Record doesnt exists'];
        return response()->json($response, 400);
    }
  }

  public function register(UserValidation $request)
  { 
    $payload = [
      'password'=>\Hash::make($request->password),
      'email'=>$request->email,
      'name'=>$request->name,
      'auth_token'=> ''
    ];
              
    $user = new User($payload);

    if ($user->save()) {
      
      $token = self::getToken($request->email, $request->password); // generate user token
      if (!is_string($token)) {
          return response()->json(['success'=>false,'data'=>'Token generation failed'], 401);
      }
      
      $user = User::where('email', $request->email)->get()->first();
      $user->auth_token = $token; // update user token
      $user->save();
      
      $response = ['success'=>true, 'data'=>['name'=>$user->name,'id'=>$user->id,'email'=>$request->email,'auth_token'=>$token]];        
    } else {
      $response = ['success'=>false, 'data'=>'Couldnt register user'];
    }
    
    return response()->json($response, 201);
  }

  public function getUserByToken() 
  {
    $user = JWTAuth::parseToken()->toUser();
    return response()->json(['success' => true, 'data' => $user]);
  }
}