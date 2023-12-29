<?php

namespace Modules\Coin\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Modules\Coin\app\Models\Last;

class LastController extends Controller
{
    protected Last $last;

    public function __construct(Last $last)
    {
        $this->last = $last;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $valorInvestido     = $this->formatMoney($request['InputCoinValue']);
        $moedaSelecionada   = $request['selectedCurrency']; #refactory
        $valorUnitario      = $request['selectCoin'];
        $valorConvertido    = $this->formatMoney($request['InputCoinValueConvert']);
        $taxaBoleto         = $this->formatMoney($request['InputCoinValueBoleto']);
        $taxaCartao         = $this->formatMoney($request['InputCoinValueCt']);
        $metodoPagamento    = $request['selectPayment'];
        $valorFinalTaxado   = $this->formatMoney($request['InputCoinValueFinalChoice']);

        $history = new History();
        $history->setAttribute('valor_investido', $valorInvestido);
        $history->setAttribute('moeda_selecionada', $moedaSelecionada);
        $history->setAttribute('valor_unitario', $valorUnitario);
        $history->setAttribute('valor_convertido', $valorConvertido);
        $history->setAttribute('taxa_boleto', $taxaBoleto);
        $history->setAttribute('taxa_cartao', $taxaCartao);
        $history->setAttribute('metodo_pagamento', $metodoPagamento);
        $history->setAttribute('valor_final_taxado', $valorFinalTaxado);
        $history->save();

        return redirect('/success')->with('success','History Successfully ');
    }

    public function formatMoney($num)
    {
        $formated = preg_replace('/[^\d\-\,]/', '', $num);
        return str_replace(',','.', $formated);
    }

    public function success()
    {
        return view('coin::success');
    }
}
