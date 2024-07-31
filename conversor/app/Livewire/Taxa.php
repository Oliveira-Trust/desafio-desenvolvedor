<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\TaxaPagamento;
use Exception;

class Taxa extends Component
{
    #[Validate('required')] 
    public $taxaBoleto = null;

    #[Validate('required')] 
    public $taxaCartao = null;

    public $isDisabled = true;


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

    public function toggleEdicao() {
        $this->isDisabled = !$this->isDisabled;
    }

    public function salvar() {
        try {
            $boleto = TaxaPagamento::where('tipo_pagamento', '=', 'Boleto')->first();
            $boleto->taxa = $this->formataValorToUS($this->taxaBoleto) / 100;
            $boleto->save();
    
            $cartao = TaxaPagamento::where('tipo_pagamento', '=', 'Cartão de Crédito')->first();
            $cartao->taxa = $this->formataValorToUS($this->taxaCartao) / 100;
            $cartao->save();

            $this->toggleEdicao();
        } catch (Exception $e) {
            dd($e);
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
    }

    public function render()
    {
        return view('taxa')->layout('layouts.app');
    }
}
