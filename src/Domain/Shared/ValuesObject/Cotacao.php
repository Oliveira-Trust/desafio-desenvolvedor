<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Shared\ValuesObject;

class Cotacao
{
    public function __construct(private TipoMoeda $moedaOrigem, private TipoMoeda $moedaDestino, private float $valorCotacao)
    {
    }

    public function getMoedaOrigem(): TipoMoeda
    {
        return $this->moedaOrigem;
    }

    public function getMoedaDestino(): TipoMoeda
    {
        return $this->moedaDestino;
    }

    public function getValorCotacao(): float
    {
        return $this->valorCotacao;
    }

    public function __toString(): string
    {
        return $this->moedaOrigem->getSigla().'/'.$this->moedaDestino->getSigla().': '.$this->valorCotacao;
    }
}
