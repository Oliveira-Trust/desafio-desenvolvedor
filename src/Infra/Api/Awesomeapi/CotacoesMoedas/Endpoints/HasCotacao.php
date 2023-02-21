<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints;

trait HasCotacao
{
    public function cotacao(): CotacaoEndpoint
    {
        return new CotacaoEndpoint();
    }
}
