<?php
// app/Http/Controllers/ConvertCurrencyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\ConvertCurrencyUseCase;
use App\Presenters\ConvertCurrencyPresenter;

class ConvertCurrencyController extends Controller
{
    private $useCase;
    private $presenter;

    public function __construct(ConvertCurrencyUseCase $useCase, ConvertCurrencyPresenter $presenter)
    {
        $this->useCase = $useCase;
        $this->presenter = $presenter;
    }

    public function convert(Request $request)
    {
        $this->validate($request, [
            'targetCurrency' => 'required|string',
            'amount' => 'required|numeric|min:1000|max:100000',
            'paymentMethod' => 'required|string|in:boleto,credit_card',
        ]);

        $conversionResult = $this->useCase->execute(
            $request->get('targetCurrency'),
            $request->get('amount'),
            $request->get('paymentMethod')
        );

        return response()->json($this->presenter->present($conversionResult));
    }
}
