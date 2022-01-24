<?php

namespace AwesomeApi\Connection;

use AwesomeApi\Models\Currency;
use Illuminate\Http\Client\Response;

interface HttpConnection
{
    public function currenciesAvailable(): Response;
    public function quoteCurrency(array $attributes): Currency;
}
