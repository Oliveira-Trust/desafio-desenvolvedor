<?php
namespace Presentation\Api\V1\Controllers;

use Application\Auth\Data\AuthLoginData;
use Application\Auth\UseCases\LoginUseCase;
use Presentation\Api\V1\Requests\Auth\AuthLoginRequest;

class AuthController {
    public function login(AuthLoginRequest $request, LoginUseCase $usecase) {
        $credentials = $request->only(['email', 'password']);
        $data = AuthLoginData::from($credentials);
        $result = $usecase->execute($data);

        return $result;
    }
}
