<?php

namespace App\Services\AwesomeAPI;

use App\Services\AwesomeAPI\Exceptions\CurrencyQuoteNotFoundException;
use App\Services\AwesomeAPI\Types\Currency;
use App\Services\AwesomeAPI\Types\CurrencyQuote;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use \Exception;
use Symfony\Component\HttpFoundation\Response;

class AwesomeAPIService
{
    const PREFIX_CACHE_KEY = 'AW';
    private readonly string $endpoint;

    function __construct() {
        $this->endpoint = config('services.awesome_api.base_url');
    }

    /**
     * Retrieves the list of available currencies.
     *
     * @return Currency[] Array of Currency objects representing the available currencies
     * @throws Exception
     */
    public function getAvailableCurrencies() : array
    {
        $cacheKey = self::PREFIX_CACHE_KEY . '_AVAILABLE_CURRENCIES';

        return Cache::remember($cacheKey, now()->addMinutes(1), function () {
            $response = Http::get("{$this->endpoint}/available/uniq");

            if ($response->failed()) {
                throw new Exception('Failed to fetch available currencies from the API.');
            }

            $data = $response->json();

            return array_map(fn($code, $currency) => new Currency($code, $currency), array_keys($data), $data);
        });
    }

    /**
     * Retrieves the exchange rate of one currency against another.
     *
     * @param string $from Code of the base currency (e.g., 'BRL').
     * @param string $to Code of the target currency (e.g., 'USD').
     * @return CurrencyQuote Exchange rate information.
     * @throws CurrencyQuoteNotFoundException | Exception
     */
    public function getCurrencyQuote(string $from, string $to) : CurrencyQuote
    {
        $response = Http::get("{$this->endpoint}/{$to}-{$from}");

        if ($response->failed()) {
            if ($response->status() === Response::HTTP_NOT_FOUND) {
                throw new CurrencyQuoteNotFoundException($from, $to);
            }

            throw new Exception('The API request failed.');
        }

        $data = $response->json();

        return new CurrencyQuote($from, $to, $data[0]['name'], $data[0]['bid'], $data[0]['ask']);
    }
}
