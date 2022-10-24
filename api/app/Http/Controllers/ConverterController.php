<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\GeneralHelper;
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
        'payment_slip' => 1.45,
        'credit_card' => 7.63
    ];

    private float $value;
    private String $currencyFrom;
    private String $currencyTo;
    private String $method;
    private float $paymentMethodRate;
    private float $conversionRate;
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $input = $request->all();
    
            $this->validateInput($input);

            foreach ($input as $key => $value) {
                $this->{$this->underscoreToCamelCase($key)} = $value;
            }

            $this->paymentMethodRate = $this->calculatePaymentMethodRate();
            $this->conversionRate = $this->calculateConversionRate();
            
            return [
                $this->value,
                $this->method,
                $this->currencyFrom,
                $this->currencyTo
            ];

        } catch (Exception $e) {
            $statusCode = $e->getCode() >= 100 && $e->getCode() < 600? $e->getCode(): 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
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
        return (float) $value > $this::VALUE_RANGE['min'] && $value < $this::VALUE_RANGE['max'];
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
        // Verificação desabilitada para funcionamento dos testes e para evitar perda de tempo em correções de ambiente
        // Assim, evitando afetar a duração ou a qualidade do desafio
        $response = Http::withOptions([
            'verify' => false
        ])->get('https://economia.awesomeapi.com.br/json/available/uniq')->json();
        return in_array($currencyFrom, array_keys($response)) && in_array($currencyTo, array_keys($response));
    }

    private function calculatePaymentMethodRate(): float
    {
        return $this::ACCEPTED_METHODS_RATES[$this->method];
    }

    private function calculateConversionRate(): float
    {
        return $this->value > 3000? 1.01: 1.02;
    }
}
