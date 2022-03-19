<?php

namespace App\Http\Requests;

use App\Models\PaymentType\PaymentType;
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paymentType' => $this->getPaymentTypeRules(),
            'destinationCurrency' => 'required',
            'value' => 'required',
        ];
    }

    private function getPaymentTypeRules(): string
    {
        return 'required|in:' . $this->formatSlugFromPaymentType(
            PaymentType::getAllSlugs()
        );
    }

    private function formatSlugFromPaymentType(Collection $allPaymentSlugs): string
    {
        return $allPaymentSlugs->join(',');
    }   
}
