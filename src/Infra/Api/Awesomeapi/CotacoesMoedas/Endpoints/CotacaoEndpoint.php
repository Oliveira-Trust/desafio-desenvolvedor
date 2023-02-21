<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\Endpoints;

use OT\ConversorMoedas\Domain\Exceptions\CotacaoNotFoundException;
use OT\ConversorMoedas\Domain\Repository\ICotacaoRepository;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\Cotacao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;
use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\CotacaoMoedaService;

class CotacaoEndpoint implements ICotacaoRepository
{
    private CotacaoMoedaService $service;

    public function __construct()
    {
        $this->service = new CotacaoMoedaService();
    }

    public function cotar(TipoMoeda $moedaOrigem, TipoMoeda $moedaDestino): Cotacao
    {
        //MELHORIA: verificar se par de conversao eh valida
        $registro = $this->service->api->get('/last/'.$moedaDestino->getSigla().'-'.$moedaOrigem->getSigla())->json($moedaDestino->getSigla().$moedaOrigem->getSigla());

        if (! $registro) {
            throw new CotacaoNotFoundException();
        }

        return new Cotacao($moedaOrigem, $moedaDestino, (float) $registro['bid']);
    }
}
