<?php

namespace Modules\Conversion\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Conversion\Models\ConversionTax;

class ConversionConfigTaxRequest extends FormRequest {

    public function validationData() {
        $this->request->set('value', set_float_format($this->get('value')));
        $this->request->set('min', set_float_format($this->get('min')));
        $this->request->set('max', set_float_format($this->get('max')));
        return $this->all();
    }

    public function rules(): array {
        return [
            'value' => ['required', 'numeric', 'between:0.1,100',  function (string $attribute, mixed $value, Closure $fail) {

                $min = $this->get('min');
                $max =  $this->get('max');
                $conversionTax = $this->route('conversion_tax');

                $exists = false;

                if (!$min && !$max) {
                    $exists = ConversionTax::withoutTrashed()->when($conversionTax, function ($q, $conversionTax) {
                        $q->where('id', '<>', $conversionTax->getKey());
                    })->exists();
                }

                if ($min || $max) {
                    $exists = ConversionTax::withoutTrashed()->where(function ($q) use($min, $max){
                        $q->when($min, function ($q, $min) {
                            $q->search(set_money_format($min));
                        });
                        $q->when($max, function ($q, $max) {
                            $q->orWhere(function ($q) use ($max) {
                                $q->search(set_money_format($max));
                            });
                        });
                    })->when($conversionTax, function ($q, $conversionTax) {
                        $q->where('id', '<>',  $conversionTax->getKey());
                    })->exists();
                }

                if ($exists) {
                    $fail("O intervalo colide com um dos intervalos já cadastrados!");
                }
            }
            ],
            'min'   => ['nullable', 'numeric', 'between:' . fieldDigits('conversion_taxs.min')],
            'max'   => ['nullable', 'numeric', 'between:' . fieldDigits('conversion_taxs.max'), $this->get('min') ? 'gt:min' : null]
        ];
    }

    public function attributes() {
        return [
            'value' => 'Taxa',
            'min'   => 'Valor mínimo',
            'max'   => 'Valor Máximo'
        ];
    }
}
