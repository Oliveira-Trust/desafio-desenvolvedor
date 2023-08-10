<?php

namespace Modules\Conversion\Drivers;

class CurrencyExchangeAwesomeapi extends CurrencyExchangeBase {

    public function getUrl(): string {
        return "https://economia.awesomeapi.com.br/json/last/{$this->currencyDestiny}-{$this->currencyOrigin}";
    }

    public function getData(): string {
        return $this->currencyDestiny . $this->currencyOrigin . '.bid';
    }
}
