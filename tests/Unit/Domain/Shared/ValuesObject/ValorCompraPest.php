<?php

use OT\ConversorMoedas\Domain\Shared\ValuesObject\Exceptions\ValorInvalidoException;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

test('Valida lançamento de exception em caso de valor menor que 1.000,00', function () {
    new ValorCompra(999);
})->throws(ValorInvalidoException::class);

test('Valida lançamento de exception em caso de valor maior que 100.000,00', function () {
    new ValorCompra(100000.25);
})->throws(ValorInvalidoException::class);
