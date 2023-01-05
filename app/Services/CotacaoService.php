<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CotacaoService
{
    private $cotacao;
    private $taxaConversao;
    private $taxaPagamento;

    public function __construct($valor, $moeda, $pagamentoId)
    {
        $this->valor = floatval($valor);
        $this->moeda = $moeda;
        $this->pagamentoTipo = $pagamentoId;
        $this->cotacao = $this->getCotacaoMoeda($moeda);
        $this->taxaConversao = $this->setTaxaConversao();
        $this->taxaPagamento = $this->setTaxaPagamento();
    }

    public function converterMoeda()
    {
        $pagamento = new PagamentoService();
        $txPagamento = $this->getTaxaPagamento();
        $txConversao = $this->getTaxaConversao();

        $taxas = [
            'pagamento'    =>  $txPagamento,
            'conversao'    =>  $txConversao,
            'total'       =>  ($txPagamento + $txConversao),
        ];

        return [
            'destino'   =>  $this->cotacao['code'],
            'valor'   =>  $this->valor,
            'pagamento_tipo'   =>  $pagamento->getInfo($this->pagamentoTipo)->nome,
            'valor_moeda'   =>  round($this->cotacao['bid'], 2),
            'valor_conversao'   => $this->valor,
            'valor_convertido' =>  $this->valor - $taxas['total'],
            'moeda_comprada'    =>  round(($this->valor - $taxas['total']) / round($this->cotacao['bid'], 2), 2), //Considerando o valor descontado as taxas e dividindo pelo valor da moeda destino
            'taxas' =>  $taxas
        ];
    }

    private function getCotacaoMoeda($moeda)
    {
        $url = env('URL_API_COTACAO') . $moeda;
        $response = Http::acceptJson()->get($url);

        $this->cotacao = $response->json($moeda.'BRL');

        return $this->cotacao;
    }

    private function getTaxaPagamento()
    {
        return $this->valor * $this->taxaPagamento;
    }

    private function setTaxaPagamento()
    {
        $taxa = new PagamentoService();

        $this->taxaPagamento = $taxa->getInfo($this->pagamentoTipo)->taxa;

        return $this->taxaPagamento;
    }

    private function getTaxaConversao()
    {
        return $this->valor * $this->taxaConversao;
    }

    private function setTaxaConversao()
    {
        $taxa = new TaxaService();
        $this->taxaConversao = $taxa->getTaxa($this->valor);

        return $this->taxaConversao;
    }
}
