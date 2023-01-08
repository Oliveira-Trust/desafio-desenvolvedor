<?php

namespace App\Services\ApiConsume\User;

use App\DTO\Entities\UserEntityData;
use App\Services\ApiConsume\BaseApiService;
use GuzzleHttp\Psr7\Response;
use function request;

class UserApiService extends BaseApiService {

    public function __construct(?string $baseUrl = null) {
        $this->baseUrl       = $baseUrl ?? config('microservices.users.api_base_url');
        $this->authorization = request()->header('Authorization') ?? request()->input('Authorization');
    }

    public function logout(): Response {
        return $this->request(method: 'POST', requestUrl: 'logout');
    }

    public function signup(array $data): Response {
        return $this->request(method: 'POST', requestUrl: 'signup', data: $data);
    }

    public function login(array $data = []): Response {
        return $this->request(method: 'POST', requestUrl: 'login', data: $data);
    }

    public function me(): Response {
        return $this->request(method: 'GET', requestUrl: 'me');
    }

    public function getUserData(): UserEntityData {
        $result = $this->requestJson(method: 'GET', requestUrl: 'me');
        return UserEntityData::from($result);
    }
}
