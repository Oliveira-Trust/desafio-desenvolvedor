<?php

namespace App\Services\AwesomeApiQuotes;

use App\Services\AwesomeApiQuotes\Endpoints\HasCurrencies;
use App\Services\AwesomeApiQuotes\Endpoints\HasQuotes;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Space Flight News Api
 * https://economia.awesomeapi.com.br
 */
class AwesomeApiQuotesService
{
    use HasQuotes, HasCurrencies;

    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->baseUrl('https://economia.awesomeapi.com.br');
    }
}
