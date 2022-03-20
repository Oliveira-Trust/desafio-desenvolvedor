<?php

namespace App\Http\Requests;

use App\Models\PaymentType\PaymentType;
use App\Services\CurrencyService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class BuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'originCurrency' => $this->originCurrency ?? 'BRL',
        ]);
    }   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paymentType' => $this->getPaymentTypeRules(),
            'originCurrency' => 'required',
            'destinationCurrency' => 'required',
            'value' => $this->getValueRules(),
        ];
    }

    public function messages(): array
    {
        return [
            'value.between' => 'The :attribute :input is not between :min and :max.',
        ];
    }

    private function getValueRules(): string
    {
        $floorValue = CurrencyService::getFloorValueToBuy();
        $ceilValue = CurrencyService::getCeilValueToBuy();

        return "required|gte:{$floorValue}|lte:{$ceilValue}";
    }

    private function getPaymentTypeRules(): string
    {
        $possibleSlugs = $this->formatSlugFromPaymentType(
            PaymentType::getAllSlugs()
        );

        return "required|in:{$possibleSlugs}";
    }

    private function formatSlugFromPaymentType(Collection $allPaymentSlugs): string
    {
        return $allPaymentSlugs->join(',');
    }   
}
