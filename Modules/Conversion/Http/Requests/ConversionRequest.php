<?php

namespace Modules\Conversion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Conversion\Models\CurrencyType;

class ConversionRequest extends FormRequest {

    public function validationData() {
        $this->request->set('value', set_float_format($this->get('value')));
        $this->request->set('currency_origin_name', 'BRL');
        $this->request->set('currency_destiny_name', CurrencyType::where('id', $this->get('currency_destiny'))->value('name'));

        return $this->all();
    }

    public function rules(): array {
        return [
            'currency_destiny' => ['required', 'exists:currency_types,id'],
            'value'            => ['required', 'numeric', 'between:' . fieldDigits('conversion.value')],
            'payment_type_id'  => ['required', 'exists:payment_types,id']
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function attributes() {
        return [
            'currency_destiny' => 'Moeda de Destino',
            'value'            => 'Valor para Conversão',
            'payment_type_id'  => 'Forma de Pagamento'
        ];
    }

    public function messages() {
        return [
            'value.between' => 'O campo :attribute deve conter um número maior que 1.000 e menor que 100.000.'
        ];
    }
}
