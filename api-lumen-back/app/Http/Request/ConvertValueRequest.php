<?php

namespace App\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConvertValueRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'originValue'   => 'required|numeric|between:1000,100000',
                'convertedCurrency' => 'required|string|in:' . implode(',', ['USD', 'EUR']),
                'paymentMethod' => 'required|string|in:' . implode(',', ['CREDIT_CARD', 'BANK_SLIP'])
            ]
        );

        parent::__construct($request);
    }
}
