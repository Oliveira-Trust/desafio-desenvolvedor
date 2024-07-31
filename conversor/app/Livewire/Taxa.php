<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\TaxaPagamento;
use App\Models\TaxaValorCompra;
use Exception;

class Taxa extends Component
{
    #[Validate('required')] 
    public $taxaBoleto = null;
    #[Validate('required')] 
    public $taxaCartao = null;


    #[Validate('required')] 
    public $valorBase = null;
    #[Validate('required')] 
    public $taxaMenorValor = null;
    #[Validate('required')] 
    public $taxaMaiorValor = null;


    public $pgtoIsDisabled = true;
    public $valorIsDisabled = true;


    public function getTaxasPagamento() {
        $taxas = TaxaPagamento::all()->toArray();

        foreach ($taxas as $tx) {
            if ($tx['tipo_pagamento'] == 'Boleto') {
                $this->taxaBoleto = $this->formataValorToBR($tx['taxa'] * 100);
            } else {
                $this->taxaCartao = $this->formataValorToBR($tx['taxa'] * 100);
            }
        }
       
    }

    public function getTaxasValor() {
        $taxasValor = TaxaValorCompra::first();

        $this->valorBase = $taxasValor['valor_base'];
        $this->taxaMenorValor = $this->formataValorToBR($taxasValor['taxa_menor_valor'] * 100);
        $this->taxaMaiorValor = $this->formataValorToBR($taxasValor['taxa_maior_valor'] * 100);
    }

    public function habilitaEdicaoPgto() {
        $this->pgtoIsDisabled = false;
    }

    public function habilitaEdicaoValor() {
        $this->valorIsDisabled = false;
    }

    public function salvarTaxaPgto() {
        try {
            $boleto = TaxaPagamento::where('tipo_pagamento', '=', 'Boleto')->first();
            $boleto->taxa = $this->formataValorToUS($this->taxaBoleto) / 100;
            $boleto->save();
    
            $cartao = TaxaPagamento::where('tipo_pagamento', '=', 'Cartão de Crédito')->first();
            $cartao->taxa = $this->formataValorToUS($this->taxaCartao) / 100;
            $cartao->save();

            $this->pgtoIsDisabled = true;
        } catch (Exception $e) {
            return response("Ocorreu um erro ao atualizar as taxas de formas de pagamento", 500);
        }
    }

    public function salvarTaxaValor() {
        try {
            $valorCompra = TaxaValorCompra::first();
            $valorCompra->valor_base = $this->formataValorToUS($this->valorBase) / 100;
            $valorCompra->taxa_menor_valor = $this->formataValorToUS($this->taxaMenorValor) / 100;
            $valorCompra->taxa_maior_valor = $this->formataValorToUS($this->taxaMaiorValor) / 100;
            $valorCompra->save();


            $this->valorIsDisabled = true;
        } catch (Exception $e) {
            return response("Ocorreu um erro ao atualizar as taxas de formas de pagamento", 500);
        }
        

    }

    function formataValorToUS($valor) {
        return floatval(str_replace(',', '.', $valor));
    }

    function formataValorToBR($valor) {
        return number_format($valor, 2, ',', '.');
    }

    public function mount() {
        $this->getTaxasPagamento();
        $this->getTaxasValor();
    }

    public function render()
    {
        return view('taxa')->layout('layouts.app');
    }
}
