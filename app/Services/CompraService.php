<?php

namespace App\Services;

use App\Models\Cotacao;
use App\Models\Moeda;
use App\Models\Pagamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;
use App\Services\TaxaService;

class CompraService{

    /**
     * @var string
     */

    private $url;
    public function __construct()
    {
        $this->url = 'https://economia.awesomeapi.com.br/last/';
    }
  public function converterMoeda($moedaDestino, $moedaInicial, $tipoPagamento, $valorInicial)
  {
      $taxaService = new TaxaService();

      $taxaConversao = $taxaService->getTaxaDeConversao($valorInicial);
      $taxaTipoPagamento = $taxaService->getTaxaTipoPagamento($tipoPagamento);

      $valorDescontadoConversao = $taxaService->aplicarTaxaConversao($valorInicial, $taxaConversao);
      $valorDescontadoTipoPagamento = $taxaService->aplicarTaxaTipoPagamento($valorInicial, $taxaTipoPagamento);

      $valorParaConversao = $taxaService->aplicarTaxas($valorInicial, $valorDescontadoConversao, $valorDescontadoTipoPagamento);

      $valorMoedaAtual = $this->getValorMoedaAtual($moedaDestino, $moedaInicial);
      $valorConvertido = $this->converteValor($valorParaConversao, $valorMoedaAtual);

      $data = [
          'usuario_id'                => Auth::id(),
          'moeda_original'            => $moedaInicial,
          'moeda_destino'             => $moedaDestino,
          'tipo_pagamento_id'         => $tipoPagamento,
          'valor_inicial'             => $valorInicial,
          'valor_taxa_conversao'      => $valorDescontadoConversao,
          'valor_taxa_tipo_pagamento' => $valorDescontadoTipoPagamento,
          'valor_inicial_taxado'      => $valorParaConversao,
          'valor_moeda_destino'       => $valorMoedaAtual,
          'valor_comprado'            => $valorConvertido
      ];

      $data = Cotacao::create($data);

      return $data;
  }

  private function getValorMoedaAtual($moedaDestino, $moedaInicial){
      $moedaDestino = Moeda::find($moedaDestino)->abreviacao_moeda;
      $moedaInicial = Moeda::find($moedaInicial)->abreviacao_moeda;

      $response = Http::get($this->url.$moedaDestino.'-'.$moedaInicial);
      return $response->json()[$moedaDestino.$moedaInicial]["bid"];
  }

  private function converteValor($valorParaConversao, $valorMoedaAtual){
      return $valorParaConversao/$valorMoedaAtual;
  }

  public function montaTela(): array
  {
      $userId = Auth::id();
      $moedas = Moeda::all();
      $tiposPagamento = Pagamento::all();


      $historicos = Cotacao::getCotacaoByUserId($userId);

      $dados = [
          'moedas'         => $moedas,
          'tiposPagamento' => $tiposPagamento,
          'historicos'     => $historicos
      ];

      return $dados;
  }

  public function trataDadosParaView($dados): array
  {
    $moedaoriginal          = $dados['moeda_original'];
    $moedaDestino           = $dados['moeda_destino'];
    $valorInicial           = $dados['valor_inicial'];
    $tipoPagamentoId        = $dados['tipo_pagamento_id'];
    $valorTaxaConversao     = round($dados['valor_taxa_conversao'], 3);
    $valorTaxaTipoPagamento = round($dados['valor_taxa_tipo_pagamento'],3);
    $valorInicialTaxado     = round($dados['valor_inicial_taxado'],3);
    $valorMoedaDestino      = round($dados['valor_moeda_destino'],3);
    $valorConvertido        = round($dados['valor_comprado'],3);

    $dadosMoedaOriginal = Moeda::find($moedaoriginal);
    $dadosMoedaDestino = Moeda::find($moedaDestino);

    $dadosPagamento = Pagamento::find($tipoPagamentoId);

      return [
        'valorInicial'             => $valorInicial,
        'dadosMoedaOriginal'       => $dadosMoedaOriginal,
        'dadosMoedaDestino'        => $dadosMoedaDestino,
        'dadosPagamento'           => $dadosPagamento,
        'valorTaxaConversao'       => $valorTaxaConversao,
        'valorTaxaTipoPagamento'   => $valorTaxaTipoPagamento,
        'valorInicialTaxado'       => $valorInicialTaxado,
        'valorMoedaDestino'        => $valorMoedaDestino,
        'valorConvertido'          => $valorConvertido
    ];
  }
}
