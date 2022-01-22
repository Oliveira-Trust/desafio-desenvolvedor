<?php

namespace AwesomeApi\Connection;

use Illuminate\Http\Client\Response;

interface HttpConnection
{
    public function currenciesAvailable(): Response;
}
