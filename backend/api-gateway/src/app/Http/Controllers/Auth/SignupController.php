<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiConsume\User\UserApiService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class SignupController extends Controller {

    public function __construct(private UserApiService $auth_api_service) { }

    /**
     * @OA\Post(
     *  path="/api/signup",
     *  summary="Signup",
     *  description="Signup",
     *  operationId="authSignup",
     *  tags={"Authentication"},
     *  @OA\RequestBody(
     *     required=true,
     *     description="Pass user data",
     *     @OA\JsonContent(
     *        required={"email","password","name"},
     *        @OA\Property(property="name", type="string", format="string", example="Jhon"),
     *        @OA\Property(property="email", type="string", format="email", example="user@user.com"),
     *        @OA\Property(property="password", type="string", format="password", example="123456"),
     *     ),
     *  ),
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function __invoke(Request $request) {

        return $this->makeResponse($this->auth_api_service->signup($request->all()));
    }
}
