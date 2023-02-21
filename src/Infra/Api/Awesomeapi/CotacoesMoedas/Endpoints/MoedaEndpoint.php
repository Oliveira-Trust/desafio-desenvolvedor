<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints;

use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;
use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\CotacaoMoedaService;

class MoedaEndpoint
{
    private CotacaoMoedaService $service;

    public function __construct()
    {
        $this->service = new CotacaoMoedaService();
    }

    public function list()
    {
        $registros = new Collection($this->service->api->get('/available/uniq')->json());
        $entities = $registros->map(function ($item, $key) {
            return new TipoMoeda($key, $item);
        });

        return $entities;
    }
}
