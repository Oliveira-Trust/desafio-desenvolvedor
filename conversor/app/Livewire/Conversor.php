<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use GuzzleHttp\Client;

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

    public const TAXA_BOLETO = 0.0145;
    public const TAXA_CARTAO = 0.0763;
    public const TAXA_VALOR_ABAIXO = 0.02;
    public const TAXA_VALOR_ACIMA = 0.01;

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

        $this->valor = $this->limpaValor($this->valor);

        $this->validate();

        $calculo = 0;
        if ($this->pagamento == 'Boleto') {
            $this->taxaFormaPgto = self::TAXA_BOLETO;
        } else {
            $this->taxaFormaPgto = self::TAXA_CARTAO;            
        }
        
        if ($this->valor < 3000) {
            $this->taxaValorConversao = self::TAXA_VALOR_ABAIXO;
        } else {
            $this->taxaValorConversao = self::TAXA_VALOR_ACIMA;
        }

        $valorMenosTaxas = $this->valor - ($this->valor * $this->taxaFormaPgto) - ($this->valor * $this->taxaValorConversao);
        $calculo = $this->formataValorToUS(($valorMenosTaxas / $this->getBid($this->moeda)));

        $this->resultado = $this->getCifrao($this->moeda) . ' ' . $calculo;

        $arr_operacoes = [
            'moeda' => $this->getCifrao($this->moeda),
            'valor' => $this->formataValorToBR($this->valor),
            'pagamento' => $this->pagamento,
            'valor_conversao' => $this->getBid($this->moeda),
            'valor_comprado' => $this->resultado,
            'taxa_pagamento' => $this->formataValorToBR($this->valor * $this->taxaFormaPgto),
            'taxa_conversao' => $this->formataValorToBR($this->valor * $this->taxaValorConversao),
            'valor_conversao_sem_taxa' => $this->formataValorToBR($this->valor - ($this->valor * $this->taxaFormaPgto) - ($this->valor * $this->taxaValorConversao))
        ];

        array_push($this->operacao, $arr_operacoes);

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

    function getBid($string) {
        $bid = explode('|', $string)[1];
        return floatval($bid);
    }

    function getCifrao($string) {
        return $string = explode('|', $string)[0];
    }

    function limpaValor($valor) {
        return floatval(str_replace('.', '', $valor));
    }

    function formataValorToBR($valor) {
        return number_format($valor, 2, ',', '.');
    }

    function formataValorToUS($valor) {
        return number_format($valor, 2, '.', ',');
    }

    public function render()
    {
        $this->listarMoedas();
        return view('livewire.conversor', ['operacao' => $this->operacao]);
    }
}
