<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Repository;

use OT\ConversorMoedas\Domain\Shared\ValuesObject\Cotacao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;

interface ICotacaoRepository
{
    public function cotar(TipoMoeda $moedaOrigem, TipoMoeda $moedaDestino): Cotacao;
}
