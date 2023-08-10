<?php

namespace Modules\Conversion\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Conversion\Http\Requests\ConversionConfigConversionRequest;
use Modules\Conversion\Models\ConversionTax;
use Modules\Conversion\Models\PaymentType;
use Modules\Conversion\Services\ConversionTaxService;

class ConversionConfigPaymentController extends Controller {

    public function edit() {
        $paymentTypes  = PaymentType::orderBy('id')->get();

        return view('conversion::config.payment.edit', compact('paymentTypes'));
    }

    public function update(ConversionConfigConversionRequest $request) {
        try {
            foreach ($request->get('payment') as $paymentTypeId => $tax) {
                PaymentType::whereKey($paymentTypeId)->update(compact('tax'));
            }

            return $this->successRoute('conversion::config.payment.edit', msg: 'Taxas atualizadas com sucesso!');
        } catch (\Exception $e) {
            return $this->errorUrl(route('conversion::config.payment.edit'), msg: 'Erro no salvamento das taxas!');
        }
    }
}
