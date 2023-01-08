<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiConsume\User\UserApiService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class LogoutController extends Controller {

    public function __construct(private UserApiService $auth_api_service) { }

    /**
     * @OA\Post(
     *  path="/api/logout",
     *  summary="Logout authenticated user",
     *  operationId="authLogout",
     *  tags={"Authentication"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function __invoke(Request $request) {

        return $this->makeResponse($this->auth_api_service->logout());

    }
}
