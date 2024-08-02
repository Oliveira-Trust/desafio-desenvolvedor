<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    public function __construct()
    {
        $this->errorBag = 'paymentMethod'.request('id');
    }

    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'id' => ['exists:payment_methods,id'],
            'name' => ['required', 'string', 'max:50', 'unique:payment_methods,name,'.request('id')],
            'label' => ['required', 'string', 'max:50', 'unique:payment_methods,label,'.request('id')],
            'tax' => ['required', 'numeric', 'min:0.01'],
            'active' => ['boolean'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
