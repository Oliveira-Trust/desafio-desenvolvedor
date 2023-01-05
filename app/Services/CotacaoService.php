<?php

namespace App\Services;

use App\Models\Historico;
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

        $data = [
            'destino'   =>  $this->cotacao['code'],
            'valor'   =>  $this->valor,
            'pagamento_tipo'   =>  $pagamento->getInfo($this->pagamentoTipo)->nome,
            'valor_moeda'   =>  round($this->cotacao['bid'], 2),
            'valor_conversao'   => $this->valor,
            'valor_convertido' =>  $this->valor - $taxas['total'],
            'moeda_comprada'    =>  round(($this->valor - $taxas['total']) / round($this->cotacao['bid'], 2), 2), //Considerando o valor descontado as taxas e dividindo pelo valor da moeda destino
            'taxas' =>  $taxas
        ];

        $this->salvarCotacao($data);

        return $data;
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

    private function salvarCotacao(array $data)
    {
        return Historico::create([
            'user_id' => auth()->user()->id,
            'moeda_origem' => 'BRL',
            'moeda_destino' => $data['destino'],
            'valor' => $data['valor'],
            'pagamento_tipo' => $data['pagamento_tipo'],
            'valor_moeda' => $data['valor_moeda'],
            'valor_conversao' => $data['valor_conversao'],
            'valor_convertido' => $data['valor_convertido'],
            'moeda_comprada' => $data['moeda_comprada'],
            'taxa_pagamento' => $data['taxas']['pagamento'],
            'taxa_conversao' => $data['taxas']['conversao'],
            'taxa_total' => $data['taxas']['total'],
        ]);
    }
}
