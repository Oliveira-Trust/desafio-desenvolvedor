<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiHelper
{
    private $api;
    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Authorization' => 'Bearer ',
        ]);
    }

    /**
     * @return \Illuminate\Http\Client\PendingRequest
     */
    public function getApi(): PendingRequest
    {
        return $this->api;
    }
}