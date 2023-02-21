<?php

use OT\ConversorMoedas\Domain\Entity\FormaPagamento;
use OT\ConversorMoedas\Domain\Exceptions\TaxaInvalidException;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;
use Ramsey\Uuid\UuidInterface;

test('Valida lançamento de exception em caso de forma de pagamento com taxa menor que 0', function () {
    new FormaPagamento('Boleto', 'BLT', -1);
})->throws(TaxaInvalidException::class);

test('Valida geração de ID', function () {
    $formaPgto = new FormaPagamento('Boleto', 'BLT', 10);
    expect($formaPgto->getID())->toBeInstanceOf(UuidInterface::class);
});

test('Valida calculo de taxa a 1,45%', function () {
    $formaPgto = new FormaPagamento('Boleto', 'BLT', 1.45);
    expect($formaPgto->getValorTaxaAplicada(new ValorCompra(5000)))->toBe(72.5);
});

test('Valida calculo de taxa a 7,63%', function () {
    $formaPgto = new FormaPagamento('CARTAO CREDITO', 'CC-1', 7.63);
    expect(round($formaPgto->getValorTaxaAplicada(new ValorCompra(5000)), 2))->toBe(381.50);
});
