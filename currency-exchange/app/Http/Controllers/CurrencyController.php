<?php

namespace App\Http\Controllers;

use App\Actions\Conversion\CreateUserConversion;
use App\DTO\CreateExchangeDTO;
use App\Http\Requests\CreateExchangeRequest;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\ExchangeApi;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private ExchangeApi $exchangeApi;
    private CreateUserConversion $createUserConversion;

    public function __construct(ExchangeApi $exchangeApi, CreateUserConversion $createUserConversion) {
        $this->createUserConversion = $createUserConversion;
        $this->exchangeApi = $exchangeApi;
    }

    public function index()
    {
        try {
            $user = User::findOrFail(auth()->user()->id);
            $conversionHistory = $user->conversion()->orderBy('created_at', 'desc')->paginate(5);
            $currencyData = $this->exchangeApi->getExchanges();
            $paymentMethod = PaymentMethod::all();

            return view('currency_exchange', [
                'currencyData' => $currencyData,
                'paymentMethod' => $paymentMethod,
                'conversion' => $conversionHistory
            ]);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage());
        }
    }

    public function create(CreateExchangeRequest $request) {
        try {
            $dto = new CreateExchangeDTO(
                value: $request->input('value'),
                paymentMethod: $request->input('payment_method'),
                baseCurrency: $request->input('base_currency'),
                targetCurrency: $request->input('target_currency')
            );

            $this->createUserConversion->execute($dto);

            return redirect()->route('currency-exchanges')
                ->with('message', 'Currency exchange request successful.');
        } catch (\Throwable $e) {
            return response()->json($e->getMessage());
        }
    }
}
