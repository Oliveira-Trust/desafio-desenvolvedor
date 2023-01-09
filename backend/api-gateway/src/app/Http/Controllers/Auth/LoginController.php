<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiConsume\User\UserApiService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class LoginController extends Controller {

    public function __construct(private UserApiService $auth_api_service) { }

    /**
     * @OA\Post(
     *  path="/api/login",
     *  summary="Login",
     *  description="Login by email and password",
     *  operationId="authLogin",
     *  tags={"Authentication"},
     *  @OA\RequestBody(
     *     required=true,
     *     description="Pass user credentials",
     *     @OA\JsonContent(
     *        required={"email","password"},
     *        @OA\Property(property="email", type="string", format="email", example="user@user.com"),
     *        @OA\Property(property="password", type="string", format="password", example="353535"),
     *     ),
     *  ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function __invoke(Request $request) {

        return $this->makeResponse($this->auth_api_service->login($request->all()));

    }
}
