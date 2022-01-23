<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entries\LoginUserEntry;
use App\Models\Services\LoginUserService;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $service = new LoginUserService(new LoginUserEntry($request));
        $service->process();

        $service->output->token = $token;
        $service->output->info_token = $this->respondWithToken($token);
        
        return response()
                    ->json($service->output)
                    ->setStatusCode(200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function verify()
    {
        return response()->json(['status' => 1,'message'=>'valid token.']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
