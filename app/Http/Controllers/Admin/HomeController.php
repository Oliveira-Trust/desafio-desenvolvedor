<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ExchangePurchaseSetupRepository;
use App\Repositories\Admin\TaxRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var ExchangePurchaseSetupRepository
     */
    private $exchangePurchaseSetupRepository;
    /**
     * @var TaxRepository
     */
    private $taxRepository;

    /**
     * @param ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository
     * @param TaxRepository $taxRepositoryy
     */
    public function __construct(ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository, TaxRepository $taxRepository)
    {
        $this->middleware('auth');
        $this->exchangePurchaseSetupRepository = $exchangePurchaseSetupRepository;
        $this->taxRepository = $taxRepository;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // pega o último setup criado
        $setup = $this->exchangePurchaseSetupRepository->orderBy('created_at', 'desc')->first();

        $taxes = $this->taxRepository->getModel()->where([['setup_id', '=', $setup->id]])->with(['interval'])->get();

        $valorCompra = $taxes->where('name', 'valor_da_compra')->first();
        $valorCompraInterval = $valorCompra->interval()->first();
        $ticket = $taxes->where('name', 'boleto')->first();
        $creditCard = $taxes->where('name', 'cartao_de_credito')->first();
        $taxaConversaoMin = $taxes->where('name', 'taxa_de_conversao_min')->first();
        $taxaConversaoIntervalMin = $taxaConversaoMin ? $taxaConversaoMin->interval()->first() : null;
        $taxaConversaoMax = $taxes->where('name', 'taxa_de_conversao_max')->first();
        $taxaConversaoIntervalMax = $taxaConversaoMax ? $taxaConversaoMin->interval()->first() : null;

        return view('admin.index', [
            'valorCompra'           => $valorCompra,
            'valorCompraInterval'   => $valorCompraInterval,
            'ticket'                => $ticket,
            'creditCard'            => $creditCard,
            'taxaConversaoMin'         => $taxaConversaoMin,
            'taxaConversaoIntervalMin' => $taxaConversaoIntervalMin,
            'taxaConversaoMax'         => $taxaConversaoMax,
            'taxaConversaoIntervalMax' => $taxaConversaoIntervalMax
        ]);
    }
}
