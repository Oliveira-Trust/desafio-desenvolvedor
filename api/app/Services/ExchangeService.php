<?php

namespace App\Services;

use App\Models\Exchange;
use Exception;
use App\Traits\GeneralHelper;
use App\Traits\ValidatorsHelper;
use App\Services\ConsumeApiService;

class ExchangeService
{
    use GeneralHelper, ValidatorsHelper;

    const VALUE_RANGE = [
        'min' => 1000,
        'max' => 100000
    ];
    const ACCEPTED_METHODS_RATES = [
        'payment_slip' => 0.0145,
        'credit_card' => 0.0763
    ];

    private object $consumeApiService;
    private float $value;
    private String $currencyFrom;
    private String $currencyTo;
    private String $method;
    private float $paymentMethodRate;
    private float $conversionRate;
    private bool $sendEmail = false;

    public function __construct()
    {
        $this->consumeApiService = app(ConsumeApiService::class);
    }

    public function simulateExchange(array $input): array
    {
        foreach ($input as $key => $value) {
            $this->{$this->underscoreToCamelCase($key)} = $value;
        }

        $this->paymentMethodRate = $this->calculatePaymentMethodRate();
        $this->conversionRate = $this->calculateConversionRate();

        $this->exchangeData = $this->getExchange($this->currencyFrom, $this->currencyTo);

        $simulatedExchange = $this->convertExchangeData();

        return array_merge([
            'value'         => $this->value,
            'method'        => $this->method,
            'currency_from' => $this->currencyFrom,
            'currency_to'   => $this->currencyTo
        ], $simulatedExchange);
    }

    public function saveExchange(object $user, array $exchange): void
    {
        $exchange['user_id'] = $user->id;

        Exchange::create($exchange);
    }

    public function getExchangesByUserId(object $user): array
    {
        $exchangeList = Exchange::where('user_id', $user->id)->paginate(20);
        return $exchangeList->toArray();
    }

    public function validateInput($input): void
    {
        $this->validateExchangeSimulation($input);
        
        if (!$this->validateValue($input['value'])) {
            throw new Exception(json_encode(['value' => ['Valor inválido']]), 400);
        }
        
        if (!$this->validateMethod($input['method'])) {
            throw new Exception(json_encode(['method' => ['Forma de pagamento inválida']]), 400);
        }
        
        if (!$this->validateCurrencies($input['currency_from'], $input['currency_to'])) {
            throw new Exception(json_encode(['currency_from/currency_to' => ['Moeda inválida']]), 400);
        }
    }

    private function validateValue(String|int|float $value): bool
    {
        return (float) $value >= $this::VALUE_RANGE['min'] && $value <= $this::VALUE_RANGE['max'];
    }

    private function validateMethod(String $method): bool
    {
        return in_array($method, array_keys($this::ACCEPTED_METHODS_RATES));
    }

    private function validateCurrencies(String $currencyFrom, String $currencyTo): bool
    {
        if ($currencyFrom === $currencyTo) {
            return false;
        }

        $response = $this->consumeApiService->fetchCurrencyList();
        return in_array($currencyFrom, array_keys($response)) && in_array($currencyTo, array_keys($response));
    }

    private function calculatePaymentMethodRate(): float
    {
        return $this::ACCEPTED_METHODS_RATES[$this->method];
    }

    private function calculateConversionRate(): float
    {
        return $this->value >= 3000? 0.01: 0.02;
    }

    private function getExchange($currencyFrom, $currencyTo): array
    {
        try {
            $response = $this->consumeApiService->getExchange($currencyFrom, $currencyTo);
            if (isset($response['status']) && $response['status'] === ConsumeApiService::NOT_FOUND_HTTP_STATUS_CODE) {
                throw new Exception('Conversão indisponível', 404);
            }
            $jsonKey = sprintf('%s%s', $currencyFrom, $currencyTo);
            return $response[$jsonKey];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    private function convertExchangeData(): array
    {
        $exchangeName = $this->exchangeData['name'];
        $exchangeDateTime = $this->exchangeData['create_date'];
        $bid = (float) $this->exchangeData['bid'];
        $paymentMethodRateDiscount = round($this->value * $this->paymentMethodRate, 2);
        $conversionRateDiscount = round($this->value * $this->conversionRate, 2);
        $discountedValue = round($this->value - $paymentMethodRateDiscount - $conversionRateDiscount, 2);
        $convertedValue = round($discountedValue * $bid, 2);

        return [
            'exchange_name'                 => $exchangeName,
            'exchange_date_time'            => $exchangeDateTime,
            'bid'                           => $bid,
            'payment_method_rate_discount'  => $paymentMethodRateDiscount,
            'conversion_rate_discount'      => $conversionRateDiscount,
            'discounted_value'              => $discountedValue,
            'converted_value'               => $convertedValue
        ];
    }
}
