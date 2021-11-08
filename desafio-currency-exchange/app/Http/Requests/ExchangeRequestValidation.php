<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\Config\BaseException;
use App\Exceptions\Config\BuildExceptions;
use App\Exceptions\Config\DefaultException;
use App\Models\Exchange;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class ExchangeRequestValidation extends FormRequest
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
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "current_purchased" => 'required',
            "type_payment" => 'required',
            "value_exchange" => 'required',
        ];
    }

    /**
     *
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'current_purchased.required' => 'Deve-se ser passado a moeda que deseja ser convertida',
            'type_payment.required' => "Deve-se ser passadp o tipo de pagamento",
            'value_exchange.required' => 'Deve-se ser passado o valor da conversão',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws TransferException
     */
    protected function failedValidation(Validator $validator)
    {

        $exception = new BaseException(
            'ValidationError',
            'Encontramos erros nos dados informados.',
            'Verifique se todos os dados foram informados corretamente',
            DefaultException::GENERAL_SUPPORT_MESSAGE,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $validator->errors()->toArray()
        );

        throw new BuildExceptions($exception);
    }

    public function validated()
    {
        $typePayment = data_get(request()->toArray(), 'type_payment');
        if (!array_key_exists($typePayment, Exchange::BILLING_TYPE)) {
            throw new \Exception('Tipo de pagamento invalido!', 400);
        }
    }
}
