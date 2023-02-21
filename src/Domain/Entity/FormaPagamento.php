<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Entity;

use OT\ConversorMoedas\Domain\Exceptions\TaxaInvalidException;
use OT\ConversorMoedas\Domain\Shared\BaseEntity;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

class FormaPagamento extends BaseEntity
{
    public function __construct(private string $nome, private string $sigla, private float $taxa, protected string $uuid = '')
    {
        if ($taxa < 0) {
            throw new TaxaInvalidException();
        }

        parent::__construct($uuid);
    }

    public function getTaxa(): float
    {
        return $this->taxa;
    }

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValorTaxaAplicada(ValorCompra $valor): float
    {
        return $valor->getValue() * ($this->taxa / 100);
    }
}
