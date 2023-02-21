<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Shared\ValuesObject;

use OT\ConversorMoedas\Domain\Shared\ValuesObject\Exceptions\ValorInvalidoException;

class ValorCompra
{
    //Ponto de melhoria: tornar estes valores manipuláveis para eventuais alterações
    const VALOR_MINIMO = 1000;

    const VALOR_MAXIMO = 100000;

    private int | float $valor;

    public function __construct(int | float $valor)
    {
        if (! $this->isValid($valor)) {
            throw new ValorInvalidoException('O Valor deve ser entre R$1.000,00 e R$100.000,00');
        }

        $this->valor = $valor;
    }

    public function getValue(): int | float
    {
        return $this->valor;
    }

    private function isValid(int | float $valor): bool
    {
        if ($valor < self::VALOR_MINIMO || $valor > self::VALOR_MAXIMO) {
            return false;
        }

        return true;
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
