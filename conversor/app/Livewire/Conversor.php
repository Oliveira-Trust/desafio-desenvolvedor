<?php

namespace App\Livewire;

use App\Models\TaxaPagamento;
use App\Models\TaxaValorCompra;
use Livewire\Attributes\Validate;
use Livewire\Component;
use GuzzleHttp\Client;
use App\Helpers\GlobalHelper;
use App\Services\Moedas;

class Conversor extends Component
{
    #[Validate('required|numeric|min:1000|max:100000')] 
    public $valor = "";
    
    #[Validate('required')] 
    public $moeda = "";

    #[Validate('required')] 
    public $pagamento = "";

    public $resultado = "";
    public $moedas = [];

    public $taxaBoleto = 0;
    public $taxaCartao = 0;

    public $valorBaseCompra = 0;
    public $taxaValorMenor = 0;
    public $taxaValorMaior = 0;

    public $taxaFormaPgto = 0;
    public $taxaValorConversao = 0;

    public $messages = [
        'valor.min' => 'O valor mínimo deve ser de R$ 1.000,00',
        'valor.max' => 'O valor máximo deve ser de R$ 100.000,00',
    ];

    public $operacao = [];
    protected $listeners = ['limparHistorico'];

    public function limparHistorico() {
        $this->operacao = [];
    }

    function converter() {

        $this->valor = GlobalHelper::limpaValor($this->valor);

        $this->validate();

        $calculo = 0;
        if ($this->pagamento == 'Boleto') {
            $this->taxaFormaPgto = $this->taxaBoleto;
        } else {
            $this->taxaFormaPgto = $this->taxaCartao;            
        }
        
        if ($this->valor < $this->valorBaseCompra) {
            $this->taxaValorConversao = $this->taxaValorMenor;
        } else {
            $this->taxaValorConversao = $this->taxaValorMaior;
        }

        $valorMenosTaxas = $this->valor - ($this->valor * $this->taxaFormaPgto) - ($this->valor * $this->taxaValorConversao);
        $calculo = GlobalHelper::formataValorToUS(($valorMenosTaxas / GlobalHelper::getBid($this->moeda)));

        $this->resultado = GlobalHelper::getCifrao($this->moeda) . ' ' . $calculo;

        $arr_operacoes = [
            'moeda' => GlobalHelper::getCifrao($this->moeda),
            'valor' => GlobalHelper::formataValorToBR($this->valor),
            'pagamento' => $this->pagamento,
            'valor_conversao' => GlobalHelper::getBid($this->moeda),
            'valor_comprado' => $this->resultado,
            'taxa_pagamento' => GlobalHelper::formataValorToBR($this->valor * $this->taxaFormaPgto),
            'taxa_conversao' => GlobalHelper::formataValorToBR($this->valor * $this->taxaValorConversao),
            'valor_conversao_sem_taxa' => GlobalHelper::formataValorToBR($this->valor - ($this->valor * $this->taxaFormaPgto) - ($this->valor * $this->taxaValorConversao))
        ];

        array_push($this->operacao, $arr_operacoes);

    }

    public function getTaxasPagamento() {
        $taxas = TaxaPagamento::all()->toArray();

        foreach ($taxas as $tx) {
            if ($tx['tipo_pagamento'] == 'Boleto') {
                $this->taxaBoleto = $tx['taxa'];
            } else {
                $this->taxaCartao = $tx['taxa'];
            }
        }
    }

    public function getTaxasValor() {
        $taxasValor = TaxaValorCompra::first();

        $this->valorBaseCompra = $taxasValor['valor_base'];
        $this->taxaValorMenor = $taxasValor['taxa_menor_valor'];
        $this->taxaValorMaior = $taxasValor['taxa_maior_valor'];
    }

    function listarMoedas() {
        $moedasSelecionadas = "USD-BRL,EUR-BRL,GBP-BRL,JPY-BRL,ARS-BRL";

        $service = new Moedas;
        $this->moedas = $service->getMoedas($moedasSelecionadas);
    }

    public function render()
    {
        $this->listarMoedas();
        $this->getTaxasPagamento();
        $this->getTaxasValor();
        
        return view('conversor', [
            'moedas' => $this->moedas,
            'resultado' => $this->resultado,
            'message' => $this->messages
        ])->layout('layouts.guest');
    }
}
