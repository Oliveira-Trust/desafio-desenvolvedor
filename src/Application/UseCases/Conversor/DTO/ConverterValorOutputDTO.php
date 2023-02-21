<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Application\UseCases\Conversor\DTO;

use OT\ConversorMoedas\Application\UseCases\Shared\BaseDTO;

class ConverterValorOutputDTO extends BaseDTO
{
    public function __construct(
        public string $origem,
        public string $destino,
        public int|float $valorCompra,
        public string $nomeFormaPagamento,
        public int|float $percentualTaxaConversao,
        public int|float $taxaConversao,
        public int|float $taxaPagamento,
        public int|float $saldoParaConversao,
        public int|float $valorCotacao,
        public int|float $valorConvertido,
    ) {
    }
}
