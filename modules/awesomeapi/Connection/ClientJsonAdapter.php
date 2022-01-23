<?php

declare(strict_types=1);

namespace AwesomeApi\Connection;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ClientJsonAdapter extends BaseHttpConnection implements HttpConnection
{
    public function currenciesAvailable(): Response
    {
        $response = Http::get($this->getBaseUrl() . AwesomeRoutes::AVAILABLE_CURRENCIES);
        throw_if($response->failed(), new \DomainException('Não foi possível listar as moedas'));
        return $response;
    }
}
