<?php

namespace Modules\Conversion\Drivers;

use Exception;
use Illuminate\Support\Facades\Http;

use Modules\Conversion\Exceptions\ConversionException;
use Modules\Conversion\Interfaces\CurrencyExchangeInterface;
use Modules\Conversion\Models\Conversion;

abstract class CurrencyExchangeBase implements CurrencyExchangeInterface {

    protected string $currencyOrigin;
    protected string $currencyDestiny;

    public function get(string $currencyOrigin, string $currencyDestiny): float|null {
        try {
            $this->currencyOrigin = $currencyOrigin;
            $this->currencyDestiny = $currencyDestiny;

            $response = Http::timeout(config('conversion.services.timeout'))
                            ->retry(config('conversion.services.retry.times'), config('conversion.services.retry.sleep'))
                            ->get($this->getUrl());

            if ($response->failed()) {
                throw new ConversionException();
            }

            $value = $response->json($this->getData());

            if (empty($value) || !is_numeric($value)) {
                throw new ConversionException();
            }

            return $value;
        } catch (Exception) {
            $currencyDestinyConversion = Conversion::where('currency_origin_name', $currencyOrigin)
                ->where('currency_destiny_name', $currencyDestiny)->latest()
                ->value('currency_destiny_conversion');

            if ($currencyDestinyConversion) {
                return $currencyDestinyConversion / 100;
            }

            throw new ConversionException();
        }
    }
}
