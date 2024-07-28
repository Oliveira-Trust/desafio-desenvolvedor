<?php

namespace App\Http\Requests\Exchange;

use App\Helpers\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExchangeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'end_currency' => [
        'required',
        Rule::in(CurrencyEnum::cases())
      ],
      'amount' => [
        'required',
        'numeric',
        'between:1000.00,100000.00'
      ],
      'payment_method_id' => [
        'required',
        'exists:payment_methods,id'
      ],
    ];
  }
}
