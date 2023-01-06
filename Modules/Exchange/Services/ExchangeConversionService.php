<?php

namespace Modules\Exchange\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Modules\Exchange\Entities\Rates;
use Modules\Exchange\Enums\PaymentMethod;
use Modules\Exchange\Repositories\Contracts\RatesRepositoryInterface;

class ExchangeConversionService
{
    protected $originCurrency;
    protected $exchange;
    protected $payRate;
    protected $payRateValue;
    protected $exchangeRate;
    protected $exchangeRateValue;
    protected $conversionValueWithFees;
    protected $purchasedValue;

    public function __construct(protected string $destinationCurrency, protected float $conversionValue, protected string $paymentMethod, protected Rates $rates)
    {
    }

    public function execute()
    {
        $this->paymentRate();

        $this->getCurrentExchangeRate();

        $this->conversionRate();

        $this->conversionValueWithFees();

        $this->purchasedValue();
    }

    public function toArray()
    {
        return [
            'origin_currency'            => $this->originCurrency,            // Moeda de origem
            'destination_currency'       => $this->destinationCurrency,       // Moeda de destino
            'conversion_value'           => $this->conversionValue,           // Valor para conversão
            'payment_method'             => $this->paymentMethod,             // Método de pagamento
            'exchange'                   => $this->exchange,                  // Câmbio atual
            'pay_rate_value'             => $this->payRateValue,              // Valor da taxa de pagamento descontado do valor para conversão
            'exchange_rate_value'        => $this->exchangeRateValue,         // Valor da taxa de câmbio descontado do valor para conversão
            'pay_rate'                   => $this->payRate,                   // Taxa de pagamento atual
            'exchange_rate'              => $this->exchangeRate,              // Taxa de câmbio descontado atual
            'conversion_value_with_fees' => $this->conversionValueWithFees,   // Valor para conversão descontado as taxas
            'purchased_value'            => $this->purchasedValue,            // Valor comprado
        ];
    }

    /**
     * @return void
     * @throws Exception
     */
    private function getCurrentExchangeRate(): void
    {
        $response = Http::retry(3, 5000, function ($exception, $request) {
            if ($exception->response->status() !== 200) {
                return $exception instanceof ConnectionException;
            }
        })->get("https://economia.awesomeapi.com.br/last/{$this->concatenationOfCurrencies('-')}");

        $this->exchange = floatval(data_get($response->json(), "{$this->concatenationOfCurrencies()}.high"));
    }

    /**
     * @param string $separation
     * @return string
     */
    private function concatenationOfCurrencies($separation = ''): string
    {
        $this->originCurrency = $this->rates->base_currency;

        return "{$this->destinationCurrency}{$separation}{$this->originCurrency}";
    }

    /** @return void  */
    private function paymentRate(): void
    {
        $this->payRate = $this->paymentMethod == PaymentMethod::BANK_SLIPS() ? $this->rates->bank_slips : $this->rates->credit_card;

        $this->payRateValue = floatval(($this->payRate/100)*$this->conversionValue);
    }

    /** @return void  */
    private function conversionRate(): void
    {
        $this->exchangeRate = $this->conversionValue > $this->rates->purchase_price ? $this->rates->purchase_price_above : $this->rates->purchase_price_below;

        $this->exchangeRateValue = floatval(($this->exchangeRate/100)*$this->conversionValue);
    }

    /** @return void  */
    private function conversionValueWithFees(): void
    {
        $this->conversionValueWithFees = $this->conversionValue - $this->sumOfFees();
    }

    /** @return float  */
    private function sumOfFees(): float
    {
        return floatval($this->payRateValue) + floatval($this->exchangeRateValue);
    }

    /** @return void  */
    private function purchasedValue(): void
    {
        $this->purchasedValue = round(floatval($this->conversionValueWithFees) / floatval($this->exchange), 2);
    }
}
