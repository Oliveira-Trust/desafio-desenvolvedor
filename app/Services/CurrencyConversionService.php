<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CurrencyConversion;
use App\Services\Payment\FormPayment;
use App\Services\Rate\ConversionRate;
use App\Exceptions\ValidateInputValueException;
use App\Http\Adapters\CurrencyConversionAdpter;
use App\Repositories\Eloquent\CurrencyConversionRepository;

class CurrencyConversionService extends BaseService
{
    /** @var int */
    private const MIX_VALUE_INPUT = 1000;

    /** @var int */
    private const MAX_VALUE_INPUT = 100000;

    protected CurrencyConversionRepository $currencyConversionRepository;

    public function __construct(CurrencyConversionRepository $currencyConversionRepository)
    {
        $this->currencyConversionRepository = $currencyConversionRepository;
    }

    public function registerConversion(
        CurrencyConversionAdpter $currencyConversionAdpter
    ): void {
        $this->validateInputValue($currencyConversionAdpter);

        $response = $this->internationalCurrencyConsultation(
            $currencyConversionAdpter->getDestinyCurrency()
        );

        $valueDestinyCurrency = $this->formatResponse($response);

        $currencyConversionAdpter->setValueDestinyCurrency(5.4);

        $paymentRate = $this->calculateformPayment(
            $currencyConversionAdpter->getValueCurrency(),
            $currencyConversionAdpter->getFormPayment()
        );

        $conversionRate = $this->calculateConversionRate(
            $currencyConversionAdpter->getValueCurrency()
        );

        $currencyConversionAdpter->setPaymentRate($paymentRate);

        $currencyConversionAdpter->setConversionRate($conversionRate);

        $currencyConversionAdpter->setValueUsedForConversion(
            $this->calculateValueUsedForConversion(
                $currencyConversionAdpter->getValueCurrency(),
                $paymentRate,
                $conversionRate
            )
        );

        $currencyConversionAdpter->setValueAcquiredInTheConversation(
            $this->calculateConversion(
                $currencyConversionAdpter->getValueUsedForConversion(),
                $valueDestinyCurrency
            )
        );

        $this->currencyConversionRepository->create(
            $currencyConversionAdpter->adapt()
        );
    }

    protected function calculateformPayment(float $value, string $typePayment): float
    {
        return (new FormPayment($value, $typePayment))->calculateformPayment();
    }

    protected function calculateConversionRate(float $value): float
    {
        return (new ConversionRate($value))->calculateConversionRate();
    }

    /** @throws ValidateInputValueException */
    protected function validateInputValue(
        CurrencyConversionAdpter $currencyConversionAdpter
    ): void {
        if (
            $currencyConversionAdpter->getValueCurrency() < self::MIX_VALUE_INPUT
            || $currencyConversionAdpter->getValueCurrency() > self::MAX_VALUE_INPUT
        ) {
            throw new ValidateInputValueException();
        }
    }

    protected function calculateValueUsedForConversion(
        float $value,
        float $paymentRate,
        float $conversionRate
    ): float {
        return $value - ($paymentRate + $conversionRate);
    }

    /** @return array[] */
    protected function internationalCurrencyConsultation(null|string $param = null): array
    {
# code...
        try {
            $response = $this->guzzleHttpClient()->get(
                $this->baseUrl($param)
            );

            return json_decode(
                $response->getBody()->getContents(),
                true
            );
        } catch (ClientException $e) {
            throw $e;
        }
    }

    /** @param string[] $reponse */
    protected function formatResponse(array $response): float
    {
        foreach ($response as $value) {
            return (float) data_get($value, 'high');
        }
    }

    protected function calculateConversion(float $value, float $valueDestinyCurrency): float
    {
        return $value / $valueDestinyCurrency;
    }

    /** @return CurrencyConversion[] */
    public function historicConversion(): array
    {
        return $this->currencyConversionRepository->getAll();
    }
}
