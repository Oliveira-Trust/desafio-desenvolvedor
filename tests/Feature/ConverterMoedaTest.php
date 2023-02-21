<?php

use OT\ConversorMoedas\Application\UseCases\Conversor\ConverterValorUC;
use OT\ConversorMoedas\Application\UseCases\Conversor\DTO\ConverterValorInputDTO;
use OT\ConversorMoedas\Application\UseCases\Conversor\DTO\ConverterValorOutputDTO;
use OT\ConversorMoedas\Infra\Api\ServiceCotacaoMemory;
use OT\ConversorMoedas\Infra\Repository\ConversaoMemoryRepository;
use OT\ConversorMoedas\Infra\Repository\FormaPagamentoMemoryRepository;

test('Converter moeda', function () {
    $input = new ConverterValorInputDTO('BRL', 'EUR', 3500, 'BLT');
    $repositoryFormaPgto = new FormaPagamentoMemoryRepository();
    $repositoryConversao = new ConversaoMemoryRepository();

    $cotacaoFake = 5.1674;
    $serviceCotacao = new ServiceCotacaoMemory($cotacaoFake);

    $ucConversao = new ConverterValorUC($input, $repositoryFormaPgto, $repositoryConversao, $serviceCotacao);
    $dtoOutput = $ucConversao->execute();

    expect($dtoOutput)->toBeInstanceOf(ConverterValorOutputDTO::class);
    expect($dtoOutput->nomeFormaPagamento)->toBe('Boleto');
    expect(round($dtoOutput->valorCotacao, 2))->toBe(round($cotacaoFake, 2));
    expect($dtoOutput->valorConvertido)->toBeFloat();
    expect(round($dtoOutput->valorConvertido, 2))->toBe(round(660.7287, 2));
});
