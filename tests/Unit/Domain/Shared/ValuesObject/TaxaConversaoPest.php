<?php

use OT\ConversorMoedas\Domain\Shared\ValuesObject\Exceptions\TaxaInvalidaException;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\Exceptions\ValorNaoAtendidoPelaFaixaException;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TaxaConversao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

test('Valida lançamento de exception em caso de taxa menor que 0', function () {
    new TaxaConversao(-1, 10, 50);
})->throws(TaxaInvalidaException::class);

test('Valida lançamento de exception em caso de ValorCompra fora da faixa da Taxa de Conversao', function () {
    $taxa1 = new TaxaConversao(5, 1000, 2000);
    $valor1 = new ValorCompra(5000);

    $taxa1->getValorTaxaAplicada($valor1);
})->throws(ValorNaoAtendidoPelaFaixaException::class);

test('Valida calculo do valor da Taxa de Conversao', function () {
    $taxa1 = new TaxaConversao(5, 1000, 2000);
    $valor1 = new ValorCompra(1500);

    $taxa2 = new TaxaConversao(10, 1000, 5000);
    $valor2 = new ValorCompra(5000);

    expect(round($taxa1->getValorTaxaAplicada($valor1), 2))->toBe(75.00);
    expect(round($taxa2->getValorTaxaAplicada($valor2), 2))->toBe(500.00);
});
