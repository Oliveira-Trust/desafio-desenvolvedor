<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EconomiaApi
{
    private string $url;
    private string $urlMethod;

    public function __construct()
    {
        $this->url = config('economiaApi.url');
        $this->urlMethod = config('economiaApi.url_method');
    }

    /**
     *
     * @param array $coins as [ [ 'BRL', 'USD' ], [ 'BRL', 'EUR ] ]
     */
    public function last(array $coins): array
    {
        $coinsUrl = $this->parseCoinsUrl($coins);
        $response = Http::accept('application/json')
            ->get("{$this->url}{$this->urlMethod}/last/{$coinsUrl}");

        return $response->json();
    }

    private function parseCoinsUrl(array $coins): string
    {
        $parsedCoins = '';
        foreach ($coins as $key => $coin) {
            $parsedCoins .= (($key > 0) ? ',' : '') . implode('-', $coin);
        }

        return $parsedCoins;
    }
}
