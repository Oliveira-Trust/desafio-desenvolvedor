<?php

namespace App\Services;

use App\Models\Cotacao;
use App\Models\Moeda;
use App\Models\Pagamento;
use Illuminate\Support\Facades\Http;

class CompraService{
    //todo:separar alguns métodos em novas classes
  public function comprarMoeda($moedaDestino, $moedaOriginal, $tipoPagamento, $valorInicial)
  {
      $taxaConversao = $this->getTaxaDeConversao($valorInicial);
      $taxaTipoPagamento = $this->getTaxaTipoPagamento($tipoPagamento);

      $valorDescontadoConversao = $this->aplicarTaxaConversao($valorInicial, $taxaConversao);
      $valorDescontadoTipoPagamento = $this->aplicarTaxaTipoPagamento($valorInicial, $taxaTipoPagamento);

      $valorParaConversao = $this->aplicarTaxas($valorInicial, $valorDescontadoConversao, $valorDescontadoTipoPagamento);

      $valorMoedaAtual = $this->getValorMoedaAtual($moedaDestino, $moedaOriginal);
      $valorConvertido = $this->converteValor($valorParaConversao, $valorMoedaAtual);

      $data = [
          'usuario_id'                => 99,
          'moeda_original'            => $moedaDestino,
          'moeda_destino'             => $moedaOriginal,
          'tipo_pagamento_id'         => $tipoPagamento,
          'valor_inicial'             => $valorInicial,
          'valor_taxa_conversao'      => $valorDescontadoConversao,
          'valor_taxa_tipo_pagamento' => $valorDescontadoTipoPagamento,
          'valor_inicial_taxado'      => $valorParaConversao,
          'valor_moeda_destino'       => $valorMoedaAtual,
          'valor_comprado'            => $valorConvertido
      ];

      Cotacao::insertData($data);

      return $data;
  }

  private function getTaxaDeConversao($valorInicial){
      $taxa = 1;

      if($valorInicial > 3000){
          $taxa = 1/100;
      }

      if($valorInicial <= 3000 && $valorInicial < 1000){
          $taxa = 2/100;
      }

      return $taxa;
  }

  private function getTaxaTipoPagamento($tipoPagamento){
      $taxa = Pagamento::getTipoPagamentoByID($moedaDestino)->abreviacao_moeda;
  }

  private function aplicarTaxaConversao($valorInicial, $taxaConversao){
      return $valorInicial*$taxaConversao;
  }

  private function aplicarTaxaTipoPagamento($valorInicial, $taxaTipoPagamento){
      return $valorInicial*$taxaTipoPagamento;
  }

  private function aplicarTaxas($valorInicial, $valorDescontadoConversao, $valorDescontadoTipoPagamento){
      return $valorInicial - ($valorDescontadoConversao + $valorDescontadoTipoPagamento);
  }

  private function getValorMoedaAtual($moedaDestino, $moedaInicial){
      $moedaDestino = Moeda::getMoedasByID($moedaDestino)->abreviacao_moeda;
      $moedaInicial = Moeda::getMoedasByID($moedaInicial)->abreviacao_moeda;

      //todo: tratar em caso de falha
      //todo:injeção de dependencia
      //todo:colocar no env o link principal
      $response = Http::get('https://economia.awesomeapi.com.br/last/'.$moedaDestino.'-'.$moedaInicial); //tratar
      return $response->json()[$moedaDestino.$moedaInicial]["bid"];
  }

  private function converteValor($valorParaConversao, $valorMoedaAtual){
      return $valorParaConversao/$valorMoedaAtual;
  }
}
