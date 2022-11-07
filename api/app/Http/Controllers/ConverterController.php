<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralHelper;
use App\Services\ConsumeApiService;
use App\Services\ExchangeService;
use Illuminate\Support\Facades\Auth;
use \Exception;

class ConverterController extends Controller
{
    use GeneralHelper;

    const ACCEPTED_INPUT_KEYS = [
        'value',
        'currency_to',
        'currency_from',
        'method'
    ];
    const VALUE_RANGE = [
        'min' => 1000,
        'max' => 100000
    ];
    const ACCEPTED_METHODS_RATES = [
        'payment_slip' => 0.0145,
        'credit_card' => 0.0763
    ];

    private object $consumeApiService;
    private object $exchangeService;
    private object|null $user;
    private float $value;
    private String $currencyFrom;
    private String $currencyTo;
    private String $method;
    private float $paymentMethodRate;
    private float $conversionRate;

    public function __construct(ConsumeApiService $consumeApiService, ExchangeService $exchangeService)
    {
        $this->consumeApiService = $consumeApiService;
        $this->exchangeService = $exchangeService;
        $this->user = Auth::user();
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = $request->all();
    
            $this->validateInput($input);

            foreach ($input as $key => $value) {
                $this->{$this->underscoreToCamelCase($key)} = $value;
            }

            $this->paymentMethodRate = $this->calculatePaymentMethodRate();
            $this->conversionRate = $this->calculateConversionRate();

            $this->exchangeData = $this->getExchange($this->currencyFrom, $this->currencyTo);

            $convertedExchangeData = $this->convertExchangeData();
            
            $exchange = array_merge([
                'value'         => $this->value,
                'method'        => $this->method,
                'currency_from' => $this->currencyFrom,
                'currency_to'   => $this->currencyTo
            ], $convertedExchangeData);

            if ($this->user) {
                $this->exchangeService->saveExchange($this->user, $exchange);
                
                // TODO Service de envio de email (caso queira enviar)
            }

            return response()->json([
                'success' => true,
                'values' => $exchange
            ], 200);

        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao simular conversão');
        }
    }

    private function validateInput($input): void
    {
        if (!$this->validateInputKeys(array_keys($input))) {
            throw new Exception('Entrada inválida', 400);
        }

        if (!$this->validateValue($input['value'])) {
            throw new Exception('Valor inválido', 400);
        }
        
        if (!$this->validateMethod($input['method'])) {
            throw new Exception('Forma de pagamento inválida', 400);
        }
        
        if (!$this->validateCurrencies($input['currency_from'], $input['currency_to'])) {
            throw new Exception('Moeda inválida', 400);
        }
    }

    private function validateInputKeys(array $inputKeys): bool
    {
        return empty(array_diff($this::ACCEPTED_INPUT_KEYS, $inputKeys));
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
