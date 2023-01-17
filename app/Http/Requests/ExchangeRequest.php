<?php

namespace App\Http\Requests;

use App\Domains\Exchange\DTO\ExchangeDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExchangeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "currency_from_id" => "required|numeric",
            "currency_to_id" => "required|numeric",
            "amount" => "required|numeric|min:1000|max:100000",
            "payment_method_id" => "required|numeric"
        ];
    }

    public function messages()
    {
        return [
            "currency_from_id.required" => "currency_from_id obrigatório!",
            "currency_from_id.integer" => "currency_from_id tem que ser do tipo inteiro!",
            "currency_to_id.required" => "Senha obrigatória!",
            "currency_to_id.integer" => "currency_to_id tem que ser do tipo inteiro!",
            "amount.required" => "Senha obrigatória!",
            "amount.float" => "amount tem que ser do tipo double!",
            'amount.max' => 'O valor do campo amount não pode ser maior que 100000.',
            'amount.min' => 'O valor do campo amount deve ser maior que 1000.',
            "payment_method_id.integer" => "payment_method_id tem que ser do tipo inteiro!",
        ];
    }

    public function toDTO(): ExchangeDTO
    {
        return new ExchangeDTO(
            Auth::user()->id,
            $this->input("payment_method_id"),
            $this->input("currency_from_id"),
            $this->input("currency_to_id"),
            $this->input("amount")
        );
    }
}
