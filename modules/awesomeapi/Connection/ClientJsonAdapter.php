<?php

declare(strict_types=1);

namespace AwesomeApi\Connection;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ClientJsonAdapter extends BaseHttpConnection implements HttpConnection
{
    public function currenciesAvailable(): Response
    {
        return Http::get($this->getBaseUrl() . AwesomeRoutes::FIRST_ROUTE);
    }
}
