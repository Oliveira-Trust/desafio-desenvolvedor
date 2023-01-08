<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeeRequest extends FormRequest {
    public function rules(): array {
        return [
            'starting_value' => ['required', 'numeric', 'gte:0', 'max::100000'],
            'fee_rate'       => ['required', 'numeric', 'gte:0', 'max::100'],
        ];
    }
}
