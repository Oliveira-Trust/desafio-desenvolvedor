<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Shared\ValuesObject;

use OT\ConversorMoedas\Domain\Shared\ValuesObject\Exceptions\TaxaInvalidaException;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\Exceptions\ValorNaoAtendidoPelaFaixaException;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

class TaxaConversao
{
    public function __construct(private int|float $taxa, private int|float $valorMin, private int|float $valorMax)
    {
        if ($taxa < 0) {
            throw new TaxaInvalidaException('A taxa de conversão deve ser maior que zero');
        }
    }

    public function getValue(): int|float
    {
        return $this->taxa;
    }

    public function getValorTaxaAplicada(ValorCompra $valor): float
    {
        if ($valor->getValue() < $this->valorMin || $valor->getValue() > $this->valorMax) {
            throw new ValorNaoAtendidoPelaFaixaException('O valor informado não possui uma taxa de conversão definida');
        }

        return $valor->getValue() * ($this->taxa / 100);
    }

    public function getValorMin(): int|float
    {
        return $this->valorMin;
    }

    public function getValorMax(): int|float
    {
        return $this->valorMax;
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
