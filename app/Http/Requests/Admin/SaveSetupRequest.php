<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveSetupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('web_admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'taxes.purchase.interval.min'        => 'required|numeric',
            'taxes.purchase.interval.max'        => 'required|numeric',
            'taxes.ticket.tax.value'             => 'required|numeric',
            'taxes.credit_card.tax.value'        => 'required|numeric',
            'taxes.conversion_rate_min.tax.value'    => 'required|numeric',
            'taxes.conversion_rate_min.interval.min' => 'required|numeric',
            'taxes.conversion_rate_max.tax.value'    => 'required|numeric',
            'taxes.conversion_rate_max.interval.max' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'taxes.purchase.interval.min.required'        => 'O campo "min" do intervalo do valor de compra é obrigatório!',
            'taxes.purchase.interval.min.numeric'         => 'O campo "min" do intervalo do valor de compra deve ser um decimal!',
            'taxes.purchase.interval.max.required'        => 'O campo "max" do intervalo do  valor de compra é obrigatório!',
            'taxes.purchase.interval.max.numeric'         => 'O campo "max" do intervalo do valor de compra deve ser um decimal!',
            'taxes.ticket.tax.value.required'             => 'O campo "Valor da Taxa do Boleto" é obrigatório!',
            'taxes.ticket.tax.value.numeric'              => 'O campo "Valor da Taxa do Boleto" deve ser um decimal!',
            'taxes.credit_card.tax.value.required'        => 'O campo "Valor da Taxa Cartão de crédito" é obrigatório!',
            'taxes.credit_card.tax.value.numeric'         => 'O campo "Valor da Taxa Cartão de crédito" deve ser um decimal!',
            'taxes.conversion_rate_min.tax.value.required'    => 'O campo "valor" da taxa de conversão é obrigatório!',
            'taxes.conversion_rate_min.tax.value.numeric'     => 'O campo  "valor" da taxa de conversão  ser um decimal!',
            'taxes.conversion_rate_min.interval.min.required' => 'O campo "Valor mínimo avaliado da compra" do intervalo da taxa de conversão  é obrigatório!',
            'taxes.conversion_rate_max.tax.value.required'    => 'O campo "valor" da taxa de conversão é obrigatório!',
            'taxes.conversion_rate_max.tax.value.numeric'     => 'O campo  "valor" da taxa de conversão  ser um decimal!',
            'taxes.conversion_rate_max.interval.min.numeric'  => 'O campo Valor máximo avaliado na "Taxa de conversão" do intervalo da taxa de conversão a deve ser um decimal!',
        ];
    }
}
