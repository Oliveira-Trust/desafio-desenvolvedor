<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest {
    public function rules(): array {
        return [
            'fee_rate' => ['required', 'numeric', 'gte:0', 'max::100'],
        ];
    }
}
