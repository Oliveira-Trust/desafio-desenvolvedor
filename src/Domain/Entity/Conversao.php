<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Entity;

use OT\ConversorMoedas\Domain\Exceptions\TaxaInvalidException;
use OT\ConversorMoedas\Domain\Shared\BaseEntity;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TaxaConversao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

/* BONUS */
class Conversao extends BaseEntity
{
    public function __construct(
        private string $moedaOrigem,
        private string $moedaDestino,
        private int|float $valorCompra,
        private string $formaPagamento,
        private int|float $percentualTaxaPagamento,
        private int|float $taxaPagamento,
        private int|float $percentualTaxaConversao,
        private int|float $taxaConversao,
        private int|float $saldoParaConversao,
        private int|float $valorCotacao,
        private int|float $valorConvertido,
        private \DateTime $data,
        protected string $uuid = ''
    ) {
        parent::__construct($uuid);
    }

    public function getMoedaOrigem(): string
    {
        return $this->moedaOrigem;
    }

    public function getMoedaDestino(): string
    {
        return $this->moedaDestino;
    }

    public function getValorCompra(): int|float
    {
        return $this->valorCompra;
    }

    public function getFormaPagamento(): string
    {
        return $this->formaPagamento;
    }

    public function getPercentualTaxaPagamento(): int|float
    {
        return $this->percentualTaxaPagamento;
    }

    public function getTaxaConversao(): int|float
    {
        return $this->taxaConversao;
    }

    public function getTaxaPagamento(): int|float
    {
        return $this->taxaPagamento;
    }

    public function getSaldoParaConversao(): int|float
    {
        return $this->saldoParaConversao;
    }

    public function getValorCotacao(): int|float
    {
        return $this->valorCotacao;
    }

    public function getValorConvertido(): int|float
    {
        return $this->valorConvertido;
    }

    public function getData(): \DateTime
    {
        return $this->data;
    }
}
