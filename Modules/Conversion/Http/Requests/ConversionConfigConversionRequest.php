<?php

namespace Modules\Conversion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Conversion\Models\PaymentType;

class ConversionConfigConversionRequest extends FormRequest {

    public function validationData() {
        $payments = $this->get('payment', []);
        $this->request->set('payment', array_map(set_float_format(...), $payments));

        return $this->all();
    }

    public function rules(): array {
        $payments = PaymentType::get(['id', 'name'])->mapWithKeys(function ($item, int $key) {
            return ['payment.' . $item['id'] => ['required', 'numeric', 'between:0.1,99.9']];
        });

        $data = [
            'payment' => ['required', 'array', 'size:2'],
        ];

        return $payments->merge($data)->toArray();
    }

    public function attributes() {
        $payments = PaymentType::get(['id', 'name'])->mapWithKeys(function ($item, int $key) {
            return ['payment.' . $item['id'] => $item['name']];
        });

        return $payments->toArray();
    }
}
