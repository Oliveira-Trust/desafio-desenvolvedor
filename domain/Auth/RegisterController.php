<?php

namespace Oliveiratrust\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Oliveiratrust\User\UserRegistrationService;
use Oliveiratrust\Base\Traits\ResponseTrait;

class RegisterController extends Controller {

    use ResponseTrait;

    public function store(RegisterRequest $request, UserRegistrationService $service): JsonResponse
    {
        $user = $service->registration($request->validated());

        return $this->successResponse(['user' => $user]);
    }
}
