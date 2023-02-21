<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Api;

use OT\ConversorMoedas\Domain\Repository\ICotacaoRepository;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\Cotacao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;

class ServiceCotacaoMemory implements ICotacaoRepository
{
    private float $cotacaoFake;

    public function __construct(float|string $cotacaoFake = '')
    {
        $this->cotacaoFake = (empty($cotacaoFake)) ? rand(0, 10).'.'.rand(0, 9999) : $cotacaoFake;
    }

    public function cotar(TipoMoeda $moedaOrigem, TipoMoeda $moedaDestino): Cotacao
    {
        return new Cotacao($moedaOrigem, $moedaDestino, (float) $this->cotacaoFake);
    }
}
