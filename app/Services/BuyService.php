<?php

namespace App\Services;

use App\Libs\AwesomeApi;
use App\Mail\Email;
use App\Models\Historic;
use App\Models\Taxe;
use Illuminate\Support\Facades\Mail;

class BuyService
{
    private $awesomeApi;

    public function __construct()
    {
        $this->awesomeApi = new AwesomeApi();
    }

    public function createNew($data)
    {

        $paymentTaxe = Taxe::where('name', $data['pagamento'])->first();

        $combination =  $data['origemMoeda'].'-'.$data['destinoMoeda'];
        $conversionKey = $data['origemMoeda'].$data['destinoMoeda'];

        $conversion = $this->awesomeApi->converter($combination);

        if(isset($conversion['status']) && $conversion['status'] === 404){
            return redirect()->back()->withErrors('Essa combinação não esta disponivel');
        }

        $originValue = floatval($data['valor']);
        $convertionTaxe = $originValue < 3000 ? 0.02 : 0.01;
        $calcConvertionTaxe = $originValue * $convertionTaxe;
        $calcPaymentTaxe =  (floatval($paymentTaxe->percentage) * $originValue) / 100;
        $newValue = $originValue - ($calcConvertionTaxe + $calcPaymentTaxe);


        $conversionData = $conversion[$conversionKey];

        $totalConverted = floatval($conversionData['bid']) * $newValue;

        $createdHistoric = Historic::create([
            'user_id' => auth()->user()->id,
            'value' => $data['valor'],
            'origin_coin' => $data['origemMoeda'],
            'destination_coin' => $data['destinoMoeda'],
            'value_with_discount' => $newValue,
            'payment_method' => $data['pagamento'],
            'value_buy' => $totalConverted,
        ]);

        Mail::to('diegooliveiratrust@gmail.com')->send(new Email($createdHistoric));

        return redirect()->route('historic');
    }
}
