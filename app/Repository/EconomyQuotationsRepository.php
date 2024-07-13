<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connections\Clients\Economy\EconomyQuotationsConnection;
use App\Exceptions\HttpClientException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

class EconomyQuotationsRepository
{
    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public function findAllCurrencyTranslations(): Response
    {
        $translations = EconomyQuotationsConnection::getCurrencyTranslations();

        throw_unless($translations->json(), HttpClientException::translationsNotFound());

        return $translations;
    }

    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public function findAllCombinations(): Response
    {
        $combinations = EconomyQuotationsConnection::getCombinations();
        $content = $combinations->json();
        $hasError = empty($content) || ($content['erro'] ?? false);

        throw_if($hasError, HttpClientException::combinationsNotFound());

        return $combinations;
    }

    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public function getQuotation(string $currencies): Response
    {
        $conversion = EconomyQuotationsConnection::getQuotation(currencies: $currencies);
        $content = $conversion->json();
        $hasError = empty($content) || ($content['erro'] ?? false);

        throw_if($hasError, HttpClientException::quotationsNotFound());

        return $conversion;
    }
}
