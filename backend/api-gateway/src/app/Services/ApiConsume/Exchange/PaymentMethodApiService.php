<?php

namespace App\Services\ApiConsume\Exchange;

use App\Services\ApiConsume\BaseApiService;

class PaymentMethodApiService extends BaseApiService {

    public function __construct(?string $baseUrl = null) {
        $this->baseUrl       = $baseUrl ?? config('microservices.exchange.api_base_url');
    }

    public function index() {
        return $this->request(method: 'GET', requestUrl: 'payment_method');
    }

    public function show($id) {
        return $this->request(method: 'GET', requestUrl: "payment_method/{$id}");
    }

    public function destroy($id) {
        return $this->request(method: 'DELETE', requestUrl: "payment_method/{$id}");
    }

    public function update($id, array $data) {
        return $this->request(method: 'PUT', requestUrl: "payment_method/{$id}", data: $data);
    }
}
