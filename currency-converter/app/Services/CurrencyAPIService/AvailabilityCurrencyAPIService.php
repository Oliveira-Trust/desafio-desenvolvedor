<?php

namespace App\Services\CurrencyAPIService;

use App\Enums\HttpMethods;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AvailabilityCurrencyApiService extends CurrencyAPIService
{
    private $origin;

    public function beforeRequest($payload) {
        return $payload;
    }

    public function afterResponse($response) {
        if (!$response) {
            return $response;
        }

        $response = collect($response);
        $currentOrigin = $this->origin;
        $filtered = $response->filter(function($description, $association) use ($currentOrigin) {
            return Str::startsWith($association, $currentOrigin);
        });
        $this->storeCache($currentOrigin, $filtered);

        return $filtered;
    }

    private function storeCache($origin, Collection $payload)
    {
        $payload = $payload->toArray();
        Cache::put("AvailabilityCurrencyApiService::{$origin}", $payload);
    }

    private function hasCache($payload)
    {
        return Cache::has("AvailabilityCurrencyApiService::{$payload}");
    }

    private function getResponseFromCache($payload)
    {
        $responseFromCache = Cache::get("AvailabilityCurrencyApiService::{$payload}");
        return $this->formatResponse(collect($responseFromCache));

    }

    public function request($payload)
    {
        $this->setOrigin($payload);

        if($this->hasCache($payload)) {
            return $this->getResponseFromCache($payload);
        }

        $response = parent::request($payload);

        return $this->formatResponse($response);
    }

    private function formatResponse(Collection $response)
    {
        return $response->map(function($description, $association) {
            $associations = explode('-', $association);
            return last($associations);
        })->toArray();
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    public function getMethod(): HttpMethods
    {
        return HttpMethods::GET;
    }

    public function getEndpoint(): string
    {
        return config(parent::BASE_CONFIG . 'availability.endpoint');
    }

    public function isEnable(): bool
    {
        return config(parent::BASE_CONFIG . 'availability.enabled');
    }
}
