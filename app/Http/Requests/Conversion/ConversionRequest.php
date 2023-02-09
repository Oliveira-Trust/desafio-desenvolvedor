<?php

namespace App\Http\Requests\Conversion;

use Illuminate\Foundation\Http\FormRequest;

class ConversionRequest extends FormRequest
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
            'purchaseAmount' => 'required|numeric|min:1000|max:100000',
            'paymentMethod' => 'required|string|not_in:0',
            'type' => 'required|string|not_in:0',
            'nameUser' => 'required',
            'emailUser' => 'required',
            'userId' => 'required',
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'purchaseAmount.required' => "O valor é obrigatório!",
            'purchaseAmount.numeric' => "O valor deve ser um número!",
            'purchaseAmount.min' => "So é permitido valores acima de R$1.000,00!",
            'purchaseAmount.max' => "So é permitido valores até R$100.000,00!",
            'paymentMethod.not_in' => "Selecione uma forma de pagamento válida!",
            'paymentMethod.required' => "Selecione uma forma de pagamento válida!",
            'paymentMethod.string' => "Selecione uma forma de pagamento válida!",
            'type.not_in' => "Selecione uma moeda válida!",
            'type.required' => "Selecione uma moeda válida!",
            'type.string' => "Selecione uma moeda válida!",
        ];
    }




    /**
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['purchaseAmount'] = request()->input('purchaseAmount');
        $data['paymentMethod'] =  request()->input('paymentMethod');
        $data['type'] =  request()->input('type');
        $data['nameUser'] =  request()->input('nameUser');
        $data['emailUser'] =  request()->input('emailUser');
        $data['userId'] =  request()->input('userId');

        request()->merge($data);

        return $data;
    }
}
