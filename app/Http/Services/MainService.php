<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\{
    ConversaoHistoricoRepository,
    MoedaRepository,
    TaxaRepository,
    TipoPagamentoRepository
};

use App\Http\Services\ApiCotacaoService;

class MainService
{
    protected $objConversaoHistoricoRepository;
    protected $objMoedaRepository;
    protected $objTaxaRepository;
    protected $objTipoPagamentoRepository;
    protected $objApiCotacaoService;

    public function __construct( ConversaoHistoricoRepository $objConversaoHistoricoRepository,
                                 MoedaRepository $objMoedaRepository, TaxaRepository $objTaxaRepository, 
                                 TipoPagamentoRepository $objTipoPagamentoRepository, ApiCotacaoService $objApiCotacaoService){
                                    
        
        $this->objConversaoHistoricoRepository = $objConversaoHistoricoRepository;
        $this->objMoedaRepository = $objMoedaRepository;
        $this->objTaxaRepository = $objTaxaRepository;
        $this->objTipoPagamentoRepository = $objTipoPagamentoRepository;
        $this->objApiCotacaoService = $objApiCotacaoService;
        
    }
            
        

    public function realizarConversao($request){

        try {
            $flValorConversao = (float) $request['flValorConversao'];
            $arObjConversao = [
                'objMoedaOrigem' => $this->objMoedaRepository->show($request['idMoedaOrigem'])->getAttributes(),
                'objMoedaDestino' => $this->objMoedaRepository->show($request['idMoedaDestino'])->getAttributes(),
                'objTipoPagamento' => $this->objTipoPagamentoRepository->show($request['idTipoPagamento'])->getAttributes(),
                'flTaxaTipoPagamento' => $this->objTaxaRepository->buscaTaxaPersonalizada($request['idTipoPagamento'],0)->getAttributes()['flTaxa'],
                'flTaxaConversao' => $this->objTaxaRepository->buscaTaxaPersonalizada(0,$flValorConversao),
            ];
            
            if( !empty($arObjConversao['objMoedaOrigem']['strSiglaMoeda'])&& !empty($arObjConversao['objMoedaDestino']['strSiglaMoeda']) ){
                
                $strParametroCotacao = $arObjConversao['objMoedaDestino']['strSiglaMoeda'].'-'.$arObjConversao['objMoedaOrigem']['strSiglaMoeda'];
               
                $arDataCotacao = array_values($this->objApiCotacaoService->buscarCotacao($strParametroCotacao));
               
            }
            $flTaxaPagamento = ($arObjConversao['flTaxaTipoPagamento']!==0 ? round(($flValorConversao*($arObjConversao['flTaxaTipoPagamento']/100)),2) : 0);
            $flTaxaConversao = ($arObjConversao['flTaxaConversao']!==0 ? round(($flValorConversao*($arObjConversao['flTaxaConversao']/100)),2) : 0);
            $flValorUtilizadoConversao = $flValorConversao-$flTaxaPagamento-$flTaxaConversao;
            
            $flValorMoedaDestino = (float) $arDataCotacao[0]['bid'];
            $flValorCompradoMoedaDestino = round(($flValorUtilizadoConversao/$flValorMoedaDestino),2);

            $arResultadoConversao = [
                'idUsuario' => auth()->user()['id'],
                'strMoedaOrigem' => $arObjConversao['objMoedaOrigem']['strSiglaMoeda'],
                'strMoedaDestino' => $arObjConversao['objMoedaDestino']['strSiglaMoeda'],
                'flValorConversao' => $flValorConversao,
                'strFormaPagamento' => $arObjConversao['objTipoPagamento']['strTipoPagamento'],
                'flValorMoedaDestinoConversao' => $flValorMoedaDestino,
                'flValorCompradoMoedaDestino' => $flValorCompradoMoedaDestino,
                'flTaxaPagamento' => $flTaxaPagamento,
                'flTaxaConversao' => $flTaxaConversao,
                'flValorUtilizadoConversao' => $flValorUtilizadoConversao
            ];


            return $this->objConversaoHistoricoRepository->updateOrCreate($arResultadoConversao);
            
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }
}
