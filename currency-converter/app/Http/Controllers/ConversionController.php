<?php

namespace App\Http\Controllers;

use App\Models\ConversionHistory;
use App\Models\FeesCharged;
use App\Providers\NumberServiceProvider;
use Illuminate\Http\Request;


class ConversionController extends Controller
{
    public function index()
    {
        $feesCharged = auth()->user()->treatingFeesCharged();

        return view( 'dashboard', compact('feesCharged') );
    }

    public function convertMoney(Request $request)
    {
        $fields         = $request->all();
        $url            = sprintf("https://economia.awesomeapi.com.br/json/last/%s-BRL", $fields['coin_to']);
        $data           = json_decode(file_get_contents($url), true);

        if(!isset($data[ $fields['coin_to'] . "BRL"])){
            return $this->responseJson([
                'status'    => 'error', 
                'message'   => 'Dados sobre moeda não encontrado'
            ]);
        }

        $feesCharged    = auth()->user()->treatingFeesCharged();
        $data           = $data[ $fields['coin_to'] . "BRL"];
        $conversionRate = $fields['money'] > $feesCharged['parameter_money'] ? $feesCharged['fee_above'] : $feesCharged['fee_below'];
        $costConversion = $fields['money'] * ($conversionRate / 100);
        $paymentRate    = $fields['money'] * (($fields['type_of_payment'] == 1 ? $feesCharged['fee_ticket'] : $feesCharged['fee_card']) / 100);
        $moneyToConvert = $fields['money'] - ($costConversion + $paymentRate);
        $priceMoney     = (float)number_format($data['high'], 2, '.');
        $convertedMoney = $moneyToConvert / $priceMoney;
        $dataConversion = [
            'user_id'           => auth()->user()->id,
            'money'             => "R$ " . NumberServiceProvider::floatToMoney($fields['money']),
            'cost_conversion'   => "R$ " . NumberServiceProvider::floatToMoney($costConversion),
            'payment_rate'      => "R$ " . NumberServiceProvider::floatToMoney($paymentRate),
            'money_convert'     => "R$ " . NumberServiceProvider::floatToMoney($moneyToConvert),
            'converted_money'   => NumberServiceProvider::floatToMoney($convertedMoney),
            'price_money'       => "R$ " . NumberServiceProvider::floatToMoney($priceMoney),
            'type_payment'      => ($fields['type_of_payment'] == 1 ? "Boleto" : "Cartão de Crédito"),
            'coin_to'           => $fields['coin_to']
        ];

        ConversionHistory::insertHistory($dataConversion);
        
        return $this->responseJson(['status' => 'ok'] + $dataConversion);
    }

    public function historyConversion()
    {
        $histories = ConversionHistory::getHistoryByUser(auth()->user()->id);

        return view( 'history', compact('histories') );
    }

    public function feesCharged()
    {
        $feesCharged = auth()->user()->treatingFeesCharged();

        return view( 'fees', compact('feesCharged') );
    }

    public function saveFeesCharged(Request $request)
    {
        $inputs     = $request->all();
        $dataSave   = [
            "money_min"         => NumberServiceProvider::moneyToFloat($inputs['money_min']),
            "money_max"         => NumberServiceProvider::moneyToFloat($inputs['money_max']),
            "fee_ticket"        => $inputs['fee_ticket'],
            "fee_card"          => $inputs['fee_card'],
            "parameter_money"   => NumberServiceProvider::moneyToFloat($inputs['parameter_money']),
            "fee_below"         => $inputs['fee_below'],
            "fee_above"         => $inputs['fee_above']
        ];

        FeesCharged::updateOrCreateByUser(auth()->user()->id, $dataSave);

        return redirect()->route('feesCharged')->with('success', 'Taxas salva com sucesso!');
    }

    public function resetFees()
    {
        $dataDefault = [
            "money_min"         => "1000.00",
            "money_max"         => "100000.00",
            "fee_ticket"        => "1.45",
            "fee_card"          => "7.63",
            "parameter_money"   => "3000.00",
            "fee_below"         => "2",
            "fee_above"         => "1"
        ];

        FeesCharged::updateOrCreateByUser(auth()->user()->id, $dataDefault);

        return redirect()->route('feesCharged')->with('success', 'Taxas redefinidas com sucesso!');
    }
}