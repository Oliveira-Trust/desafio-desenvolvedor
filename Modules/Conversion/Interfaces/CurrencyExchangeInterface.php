<?php

namespace Modules\Conversion\Interfaces;

interface CurrencyExchangeInterface {
    public function getUrl(): string;

    public function getData(): string;

    public function get(string $currencyOrigin, string $currencyDestiny): float|null;
}
