<?php

namespace App\Actions;

use App\Apis\AwesomeApi;
use App\Models\PaymentMethod;
use App\Models\Quotation;
use App\Models\TaxConversion;
use App\Models\User;
use App\Services\QuotationResponseService;
use App\Services\TaxCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CreateQuotationAction
{
    public function __construct(
        private readonly TaxCalculationService  $taxCalculationService,
        private readonly QuotationResponseService $quotationResponseService,
        public Quotation $quotation
    )
    {}
    public function rules(): array
    {
        return [
            'conversion_amount' => 'required|string',
            'destination_currency' => 'required|string',
            'payment_method_id' => 'required|string',
        ];
    }

    public function execute(Request $request)
    {
        $data = $request->validate($this->rules());

        $amount = floatval($data['conversion_amount']);

        $data['conversion_amount'] = $amount;

        $apiQuotation = $this->quotationResponseService->convertToCollection(app(AwesomeApi::class)->getQuotation());

        $user = auth()->user();

        $paymentTax = $this->paymentMethodTax($data);

        $conversionTax = $this->conversionTax($data);

        $currencyAvailable = $this->calculateConversion($data, $paymentTax, $conversionTax, $apiQuotation);

        return $this->storeQuotation($user, $data, $apiQuotation, $paymentTax, $conversionTax, $currencyAvailable);

    }

    private function paymentMethodTax(array $data): float
    {
        $paymentTax = PaymentMethod::findOrFail($data['payment_method_id']);

        return $this->taxCalculationService->calculatePercentageOfValue($paymentTax->method_tax, $data['conversion_amount']);
    }

    private function conversionTax(array $data): float
    {
        $conversionTax = TaxConversion::findOrFail(TaxConversion::DEFAULT_TAX_CONVERSION_ID);
        if($data['conversion_amount'] <= $conversionTax->reference_value){
            return $this->taxCalculationService->calculatePercentageOfValue($conversionTax->down_value_tax, $data['conversion_amount']);
        } else {
            return $this->taxCalculationService->calculatePercentageOfValue($conversionTax->up_value_tax, $data['conversion_amount']);
        }
    }

    private function calculateConversion(array $data, float $paymentTax, float $conversionTax, Collection $apiQuotation): float
    {
        $netAmount = $data["conversion_amount"] - ($paymentTax + $conversionTax);
        $currencyRate = $apiQuotation->firstWhere('code', $data['destination_currency'])->ask;

        return $netAmount / $currencyRate;
    }

    private function storeQuotation(
        $user,
        array $data,
        Collection $apiQuotation,
        float $paymentTax,
        float $conversionTax,
        float $currencyAvailable
    ): Quotation
    {
        return $this->quotation->create([
            'user_id'   => $user->id,
            'payment_method_id' => $data['payment_method_id'],
            'origin_currency' => $this->quotation::ORIGIN_CURRENCY,
            'destination_currency'  => $apiQuotation->firstWhere('code', $data['destination_currency'])->code,
            'quotation' => $apiQuotation->firstWhere('code', $data['destination_currency'])->ask,
            'payment_tax'   => $paymentTax,
            'conversion_tax'   => $conversionTax,
            'conversion_amount' => $data['conversion_amount'],
            'conversion_net_amount' => $data["conversion_amount"] - ($paymentTax + $conversionTax),
            'destination_currency_available' => $currencyAvailable,
        ]);
    }
}
