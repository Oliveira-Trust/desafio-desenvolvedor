<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Application\UseCases\Conversor\DTO;

use OT\ConversorMoedas\Application\UseCases\Shared\BaseDTO;

class ConverterValorInputDTO extends BaseDTO
{
    public function __construct(
        public string $origem,
        public string $destino,
        public int | float $valorCompra,
        public string $siglaFormaPagamento,
    ) {
    }
}
