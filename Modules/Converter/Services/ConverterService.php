<?php

namespace Modules\Converter\Services;

use Modules\Converter\Services\Contracts\ConverterServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Modules\Converter\Entities\ConversionHistory;
use Modules\Converter\Repositories\Contracts\ConversionHistoryRepositoryInterface;

class ConverterService implements ConverterServiceInterface
{
    private $conversionHistoryRepository;

    public function __construct(ConversionHistoryRepositoryInterface $conversionHistoryRepository)
    {
        $this->conversionHistoryRepository = $conversionHistoryRepository;
    }

    public function makeConversion(string $destinationCurrency, float $value): array
    {
        $destinationCurrencyValue = $this->getDestinationCurrencyValue($destinationCurrency);
        $purchaseValue = $this->calcPurchasedValue($destinationCurrencyValue, $value);

        return [
            'destination_currency_value' => $destinationCurrencyValue,
            'purchase_value' => number_format($purchaseValue, 2, ',', '.')
        ];
    }

    public function getDestinationCurrencyValue(string $destinationCurrency): float
    {
        $client = new Client();

        try {
            $response = $client->get("https://economia.awesomeapi.com.br/last/$destinationCurrency-BRL");
            $content = $response->getBody()->getContents();
            $arrayContent = json_decode($content, true);

            return floatval(array_values($arrayContent)[0]['bid']);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $content = $e->getResponse()->getBody()->getContents();

                throw new \Exception("Falha na requisição para obter a cotação da moeda: código $statusCode - $content");
            } else {
                throw new \Exception("Falha na requisição para obter a cotação da moeda: " . $e->getMessage());
            }
        }
    }

    public function calcPurchasedValue(float $destinationCurrencyValue, float $sourceCurrencyValue): float
    {
        return $sourceCurrencyValue / $destinationCurrencyValue;
    }

    public function recordConversionHistory(array $data): ConversionHistory
    {
        $data['user_id'] = auth()->user()->id;
        return $this->conversionHistoryRepository->store($data);
    }
}
