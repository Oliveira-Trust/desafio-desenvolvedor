<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\ConversionFormRequest;
use App\Http\Services\CotationService;
use App\Mail\CotationMail;
use App\Models\HistoryCotation;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CoinConversionController extends Controller
{

    public function getFormConversion()
    {
        return view('conversion.form');
    }


    /**
     * @throws GuzzleException
     */
    /* A method that receives a request and returns a json with the conversion of the currency. */
    public function coversion(ConversionFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token', '_method');
            $result = (new CotationService)->convertCoin($data);

            $conversionTax = $this->conversionTax($data['amount']);
            $paymentTax = $this->paymentTax($data['amount'], $data['payment_type']);
            $value = $data['amount'] - $paymentTax - $conversionTax;

            $response = [
                'currency_origin' => $data['currency_origin'],
                'currency_buy' => $data['currency_buy'],
                'amount' => Helper::formatValue($data['amount']),
                'currency_value' => Helper::formatValue($result->bid),
                'payment_type' => HistoryCotation::returnPaymentType($data['payment_type']),
                'value_bought' => $this->valueBought($value, $result->bid),
                'payment_tax' => $paymentTax,
                'conversion_tax' => $conversionTax,
                'conversion_value' => Helper::formatValue($value)
            ];

            $response['user_id'] = auth()->user()->id;
            HistoryCotation::query()->create($response);
            $response['name'] = auth()->user()->name;

            Mail::to(auth()->user()->email)->send(new CotationMail($response));
            DB::commit();

            return view('conversion.result', ['response' => (object)$response]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ocorreu um erro ao realizar cotação: ' . $e->getMessage());
            return redirect()->back()->with('status', 'Ocorreu um erro ao realizar cotação');
        }
    }


    private function conversionTax($amount)
    {
        $taxConversation = 0;
        if ($amount < 3000) {
            $taxConversation = 2;
        } elseif ($amount > 3000) {
            $taxConversation = 1;
        }
        return number_format($amount * ($taxConversation / 100), 2);
    }

    private function paymentTax($amount, $paymentType)
    {
        $tax = match ($paymentType) {
            "boleto" => 1.45,
            "credit_card" => 7.63,
            default => 0
        };
        return number_format($amount * ($tax / 100), 2);
    }

    private function valueBought($amount, $valueBid)
    {
        $value = ($amount / $valueBid);
        return Helper::formatValue($value);
    }


}
