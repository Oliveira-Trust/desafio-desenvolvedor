<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints\HasCotacao;
use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints\HasMoedas;

class CotacaoMoedaService
{
    use HasMoedas;
    use HasCotacao;

    public PendingRequest $api;

    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Accept' => 'application/json',
        ])->baseUrl(env('API_CONVERSAO_MOEDAS'));
    }
}
