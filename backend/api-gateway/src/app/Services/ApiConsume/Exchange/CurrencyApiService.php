<?php

namespace App\Services\ApiConsume\Exchange;

use App\Services\ApiConsume\BaseApiService;

class CurrencyApiService extends BaseApiService {

    public function __construct(?string $baseUrl = null) {
        $this->baseUrl       = $baseUrl ?? config('microservices.exchange.api_base_url');
    }

    public function index() {
        return $this->request(method: 'GET', requestUrl: 'currency');
    }
}
