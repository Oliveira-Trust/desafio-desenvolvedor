<?php

namespace App\Services;

use App\Models\Pagamento;
use App\Models\Taxa;

class TaxaService{
  public function getTaxaDeConversao($valorInicial){
      $taxa = Taxa::first();
      if($valorInicial >= $taxa->valor_limite){
          return $taxa->taxa_acima;
      }else{
          return $taxa->taxa_abaixo;
      }
  }

  public function getTaxaTipoPagamento($tipoPagamento){
      return Pagamento::find($tipoPagamento)->valor_taxa;
  }

  public function aplicarTaxaConversao($valorInicial, $taxaConversao){
      return $valorInicial*$taxaConversao;
  }

  public function aplicarTaxaTipoPagamento($valorInicial, $taxaTipoPagamento){
      return $valorInicial*$taxaTipoPagamento;
  }

  public function aplicarTaxas($valorInicial, $valorDescontadoConversao, $valorDescontadoTipoPagamento){
      return $valorInicial - ($valorDescontadoConversao + $valorDescontadoTipoPagamento);
  }

  public function getDadosPainelTaxa(): array
  {
      $tiposPagamento = Pagamento::all()->toArray();
      $taxaConversao = Taxa::all()->toArray();

      return [
          'tiposPagamento' => $tiposPagamento,
          'taxaConversao' => $taxaConversao
      ];
  }

  public function UpdateTaxaConversao($dados)
  {
      $dadoTratado = [
          'valor_limite' => $dados['valor_limite'],
          'taxa_abaixo'  => ($dados['taxa_abaixo']/100),
          'taxa_acima'   => ($dados['taxa_acima']/100),
      ];

      return Taxa::find($dados['id'])->update($dadoTratado);
  }

  public function UpdateTaxaPagamento($dados)
  {
      $taxa = Pagamento::find($dados['id']);
      $taxa->valor_taxa = ($dados['valor_taxa']/100);

      $taxa->save();
  }
}
