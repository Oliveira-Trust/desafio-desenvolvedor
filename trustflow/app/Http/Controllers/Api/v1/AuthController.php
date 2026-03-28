<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Auth
 * 
 * Group for managing user access.
 */
class AuthController extends Controller
{
    /**
     * User Login
     * This endpoint validates the user and returns an access token.
     * @bodyParam email string required The user's email address. Example: email@test.com
     * @bodyParam password string required The access password. Example: Password123
     * @response 200 {
     *     'message': 'Login successful',
     *     'token': '1|ouewrkj...'
     * }
     * 
     * @response 403 {
     *      'message': 'invalid credentials'
     * }
     * 
     * @response 422 {
     *      "message": "The email field is required.",
     *       "errors": {
     *          "email": [
     *             "The email field is required."
     *         ]
     *     }
     * }
     * 
     */
    public function login(Request $request) 
    {
        $validate = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        
        if(!Auth::attempt($validate)) {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }

        return response()->json([
            'message' => 'Login successful', 
            'token' => $request->user()->createToken('user')->plainTextToken
        ]);
    }


    /**
     * User Logout
     * This endpoint invalidates the current token and removes the user's access to the protected routes.
     * @authenticated
     * @response 200 {
     *  'message': 'Logged out successfully' 
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
