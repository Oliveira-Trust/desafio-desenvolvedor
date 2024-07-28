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


    public $messages = [
        'valor.min' => 'O valor mínimo deve ser de R$ 1000',
        'valor.max' => 'O valor máximo deve ser de R$ 100.000,00',
    ];

    function converter() {

        $this->valor = floatval($this->limpaValor($this->valor));
        $this->validate();

        $calculo = 0;
        if ($this->pagamento == 'boleto') {
            $calculo = $this->formataValorToUS(($this->valor / $this->getBid($this->moeda)) - ($this->valor * self::TAXA_BOLETO));
        } else {
            $calculo = $this->formataValorToUS(($this->valor / $this->getBid($this->moeda)) - ($this->valor * self::TAXA_CARTAO));
        }

        $this->valor = $this->formataValorToBR($this->valor);
        $this->resultado = $this->getCifrao($this->moeda) . ' ' . $calculo;

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
        return str_replace('.', '', $valor);
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
        return view('livewire.conversor');
    }
}
