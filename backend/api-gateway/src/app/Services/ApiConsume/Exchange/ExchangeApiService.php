<?php

namespace App\Services\ApiConsume\Exchange;

use App\Services\ApiConsume\BaseApiService;

class ExchangeApiService extends BaseApiService {

    public function __construct(?string $baseUrl = null) {
        $this->baseUrl       = $baseUrl ?? config('microservices.exchange.api_base_url');
    }

    public function indexByUserId($user_id) {
        return $this->request(method: 'GET', requestUrl: "exchange/by_user_id/{$user_id}");
    }

    public function showByUserId($user_id, $id) {
        return $this->request(method: 'GET', requestUrl: "exchange/by_user_id/{$user_id}/{$id}");
    }

    public function create(array $data, $user_id, string $email) {
        $data = ['user_id' => $user_id, 'email' => $email] + $data;
        return $this->request(method: 'POST', requestUrl: "exchange", data: $data);
    }
}
