<?php

namespace App\Http\Requests;

class CambioRequest extends CustomRulesRequest
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

    public function emptyValidate(): Array
    {
        return [ ];
    }

    public function validateToConverter(): Array
    {
        return [
            "cambio" => 'required|array|max:2',
            "cambio.*.moeda" => 'required|string|distinct|not_in:BRL,BRLT',
            "cambio.*.valor" => 'required|numeric|min:1000|max:100000',
            "cambio.*.forma_pagamento" => 'required|string|in:BOLETO,CARTAO',
        ];
    }
}
