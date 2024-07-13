<?php

declare(strict_types=1);

namespace App\Connections\Clients\Economy;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class EconomyQuotationsConnection
{
    /** @throws RequestException */
    public static function getCurrencyTranslations(): Response
    {
        return Http::get(Routes::currencyTranslations())->throw();
    }

    /** @throws RequestException */
    public static function getCombinations(): Response
    {
        return HTTP::get(Routes::combinations())->throw();
    }

    public static function getQuotation(string $currencies): Response
    {
        return HTTP::get(Routes::quotation(currencies: $currencies))->throw();
    }
}
