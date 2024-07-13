<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Random\RandomException;

class LoginController extends Controller
{
    private AuthServices $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    /**
     * @throws \Throwable
     * @throws RandomException
     */
    public function login(LoginFormRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $userAuthenticated = $this->authServices->authenticate(attributes: $attributes);

        return response()->json(
            $userAuthenticated,
            Response::HTTP_OK
        );
    }

    public function verify(LoginFormRequest $request): JsonResponse
    {
        $userVerified = $this->authServices->verify();

        return response()->json(
            $userVerified,
            Response::HTTP_OK
        );
    }
}
