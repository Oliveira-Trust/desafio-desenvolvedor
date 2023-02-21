<?php

namespace App\Http\Livewire;

use App\Models\Conversao;
use App\Models\TaxaConversao;
use App\Models\TipoMoeda;
use Livewire\Component;
use OT\ConversorMoedas\Infra\Repository\ConversaoEloquentRepository;

class Historico extends Component
{
    private $repositoryConversao;

    protected $listeners = ['novaConversao' => 'updateHistorico'];

    public $conversoes = [];

    public function __construct()
    {
        $this->repositoryConversao = new ConversaoEloquentRepository(new TipoMoeda(), new TaxaConversao(), new Conversao());
    }

    public function mount()
    {
        $this->updateHistorico();
    }

    public function render()
    {
        return view('livewire.historico');
    }

    public function updateHistorico()
    {
        $conversoes = $this->repositoryConversao->listAll();
        $this->conversoes = $conversoes->map(function ($item) {
            $conversao = [
                'moeda_origem' => $item->getMoedaOrigem(),
                'moeda_destino' => $item->getMoedaDestino(),
                'valor_compra' => $item->getValorCompra(),
                'forma_pgto' => $item->getFormaPagamento(),
                'perc_taxa_pgto' => $item->getPercentualTaxaPagamento(),
                'taxa_pagamento' => $item->getTaxaPagamento(),
                'perc_taxa_conversao' => $item->getPercentualTaxaPagamento(),
                'taxa_conversao' => $item->getTaxaConversao(),
                'saldo_conversao' => $item->getSaldoParaConversao(),
                'valor_cotacao' => $item->getValorCotacao(),
                'valor_convertido' => $item->getValorConvertido(),
                'data' => $item->getData()->format('d/m/Y H:i:s'),
            ];

            return $conversao;
        })->toArray();
    }
}
