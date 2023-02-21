<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints;

use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints\MoedaEndpoint;

trait HasMoedas
{
    public function moedas(): MoedaEndpoint
    {
        return new MoedaEndpoint();
    }
}
