<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxaConversaoRequest;
use App\Services\CompraService;
use App\Services\TaxaService;
use Illuminate\Http\Request;

class TaxaController extends Controller
{
    private $taxaService;
    public function __construct() {
        $this->taxaService = new TaxaService();
    }

    public function taxaPainel(){
        $dados = $this->taxaService->getDadosPainelTaxa();
        return view('taxa/taxa-painel-view', $dados);
    }

    public function salvaTaxaConversao(TaxaConversaoRequest $request){
        $dados = [
            'id'           => $request->id,
            'valor_limite' => $request->valorLimite,
            'taxa_abaixo'  => $request->taxaAbaixo,
            'taxa_acima'   => $request->taxaAcima,
        ];

        $this->taxaService->UpdateTaxaConversao($dados);
    }

    public function salvaTaxaPagamento(Request $request){
        $dados = [
            'id'           => $request->id,
            'valor_taxa'   => $request->taxa,
        ];

        $this->taxaService->UpdateTaxaPagamento($dados);
    }
}
