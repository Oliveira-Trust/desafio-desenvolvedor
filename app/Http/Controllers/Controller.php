<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'token'         => $token,
            'token_type'    => 'bearer',
            'expires_in'    => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
