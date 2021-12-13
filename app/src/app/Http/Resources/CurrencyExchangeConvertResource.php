<?php

namespace App\Http\Resources;

use App\Models\CurrencyExchangeLogs;
use App\Modules\CurrencyExchange\Module;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyExchangeConvertResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'originCurrency' => $this->originCurrency,
            'destinationCurrency' => $this->destinationCurrency,
            'originCurrencyValue' => number_format($this->originCurrencyValue, 2, ',', '.'),
            'paymentMethod' => (new CurrencyExchangeLogs())->getPaymentMethodAttribute($this->paymentMethod),
            'destinationCurrencyBaseValue' => number_format($this->destinationCurrencyBaseValue, 2, ',', '.'),
            'convertedValue' => number_format($this->convertedValue, 2, ',', '.'),
            'paymentTax' => number_format($this->paymentTax, 2, ',', '.'),
            'conversionTax' => number_format($this->conversionTax, 2, ',', '.'),
            'originCurrencyNetValue' => number_format($this->originCurrencyNetValue, 2, ',', '.'),
        ];
    }
}
