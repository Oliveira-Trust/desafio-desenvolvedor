<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiConsume\User\UserApiService;
use OpenApi\Annotations as OA;

class ProfileController extends Controller {

    public function __construct(private UserApiService $auth_api_service) { }

    /**
     * @OA\Get(
     *  path="/api/profile",
     *  summary="Retrieve profile information",
     *  description="Get profile short information",
     *  operationId="profileShow",
     *  tags={"Authentication"},
     *  security={ {"bearerAuth": {}} },
     *  @OA\Response( response=200, description="OK", ),
     * )
     */
    public function show() {
        return $this->makeResponse($this->auth_api_service->me());
    }
}
