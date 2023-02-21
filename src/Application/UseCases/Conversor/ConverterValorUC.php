<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Application\UseCases\Conversor;

use OT\ConversorMoedas\Application\UseCases\Conversor\DTO\ConverterValorInputDTO;
use OT\ConversorMoedas\Application\UseCases\Conversor\DTO\ConverterValorOutputDTO;
use OT\ConversorMoedas\Domain\Entity\Conversao;
use OT\ConversorMoedas\Domain\Repository\IConversaoRepository;
use OT\ConversorMoedas\Domain\Repository\ICotacaoRepository;
use OT\ConversorMoedas\Domain\Repository\IFormaPagamentoRepository;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;
use OT\ConversorMoedas\Infra\Api\IServiceCotacao;

class ConverterValorUC
{
    public function __construct(
        private ConverterValorInputDTO $input,
        private IFormaPagamentoRepository $repositoryFormaPgto,
        private IConversaoRepository $repositoryConversao,
        private ICotacaoRepository $serviceCotacao,
    ) {
    }

    public function execute()
    {
        $vlCompra = new ValorCompra($this->input->valorCompra);

        /** @var OT\ConversorMoedas\Domain\Entity\FormaPagamento; */
        $formaPagamento = $this->repositoryFormaPgto->findBySigla($this->input->siglaFormaPagamento);
        $txConversao = $this->repositoryConversao->findTaxaConversaoByValor($vlCompra);

        $vlTxPagamento = $formaPagamento->getValorTaxaAplicada($vlCompra);
        $vlTxConversao = $txConversao->getValorTaxaAplicada($vlCompra);

        $saldoParaConversao = $vlCompra->getValue() - $vlTxPagamento - $vlTxConversao;

        $moedaOrigem = $this->repositoryConversao->findMoedaBySigla($this->input->origem);
        $moedaDestino = $this->repositoryConversao->findMoedaBySigla($this->input->destino);

        $valorCotacao = $this->serviceCotacao->cotar($moedaOrigem, $moedaDestino);

        $valorConvertido = $saldoParaConversao / $valorCotacao->getValorCotacao();

        $conversao = new Conversao(
            $moedaOrigem->getSigla(),
            $moedaDestino->getSigla(),
            $vlCompra->getValue(),
            $formaPagamento->getNome(),
            $formaPagamento->getTaxa(),
            $vlTxPagamento,
            $txConversao->getValue(),
            $vlTxConversao,
            $saldoParaConversao,
            $valorCotacao->getValorCotacao(),
            $valorConvertido,
            new \DateTime()
        );

        $this->repositoryConversao->create($conversao);

        return new ConverterValorOutputDTO(
            $moedaOrigem->getNome(),
            $moedaDestino->getNome(),
            $vlCompra->getValue(),
            $formaPagamento->getNome(),
            $txConversao->getValue(),
            $vlTxConversao,
            $vlTxPagamento,
            $saldoParaConversao,
            $valorCotacao->getValorCotacao(),
            $valorConvertido
        );
    }
}
