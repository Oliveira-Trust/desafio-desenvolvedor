<?php

namespace App\Livewire;

use App\Models\TaxaPagamento;
use App\Models\TaxaValorCompra;
use Livewire\Attributes\Validate;
use Livewire\Component;
use GuzzleHttp\Client;
use App\Helpers\GlobalHelper;

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
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://economia.awesomeapi.com.br/json/last/USD-BRL,EUR-BRL,GBP-BRL,JPY-BRL,ARS-BRL');
    
            if ($response->getStatusCode() === 200) {
                $this->moedas = json_decode($response->getBody(), true);
            }
    
            $arr_moedas = collect(json_decode($response->getBody(), true));
            $this->moedas = $arr_moedas->map(function($arr) {
                $temp = explode('/', $arr['name']);
                return ['code' => $arr['code'], 'name' => $temp[0], 'bid' => $arr['bid']];
            });

        } catch (\Exception $e) {
            return response("Ocorreu um erro ao listar as moedas", 500);
        }
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
        ])->layout('layouts.app');
    }
}
