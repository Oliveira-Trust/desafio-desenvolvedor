<?php

namespace App\Services\ApiConsume\Exchange;

use App\Services\ApiConsume\BaseApiService;

class FeeApiService extends BaseApiService {

    public function __construct(?string $baseUrl = null) {
        $this->baseUrl       = $baseUrl ?? config('microservices.exchange.api_base_url');
    }

    public function index() {
        return $this->request(method: 'GET', requestUrl: 'fee');
    }

    public function show($id) {
        return $this->request(method: 'GET', requestUrl: "fee/{$id}");
    }

    public function destroy($id) {
        return $this->request(method: 'DELETE', requestUrl: "fee/{$id}");
    }

    public function update($id, array $data) {
        return $this->request(method: 'PUT', requestUrl: "fee/{$id}", data: $data);
    }

    public function create(array $data) {
        return $this->request(method: 'POST', requestUrl: "fee", data: $data);
    }
}
