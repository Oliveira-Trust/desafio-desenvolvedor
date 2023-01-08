<?php

namespace App\Services\ApiConsume\User;

use App\DTO\Entities\UserEntityData;
use App\Services\ApiConsume\BaseApiService;
use function request;

class UserApiService extends BaseApiService {

    public function __construct(?string $baseUrl = null) {
        $this->baseUrl       = $baseUrl ?? config('microservices.users.api_base_url');
        $this->authorization = request() ? request()->header('Authorization') ?? request()->input('Authorization') : null;
    }
    public function show($id): UserEntityData {
        $result = $this->requestJson(method: 'GET', requestUrl: "user/{$id}");
        return UserEntityData::from($result);
    }

    public function getUserData(): UserEntityData {
        $result = $this->requestJson(method: 'GET', requestUrl: 'me');
        return UserEntityData::from($result);
    }
}
