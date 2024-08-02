<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\TransactionEloquentRepository;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Module\Broker\Gateway\EconomyAwesomeApiGateway;
use Module\Broker\Gateway\LaravelMailNotification;
use Module\Broker\UseCases\CreateTransactionUseCase;
use Module\Broker\UseCases\InputTransaction;

class CurrencyController extends Controller
{
    public function convert(StoreTransactionRequest $request)
    {
        try {
            $useCase = new CreateTransactionUseCase(new EconomyAwesomeApiGateway, new TransactionEloquentRepository, new LaravelMailNotification);
            $useCase->execute(new InputTransaction(
                currencyDestination: $request->validated('currency_destination'),
                amount: $request->validated('amount'),
                paymentMethod: $request->validated('payment_method')
            ));

            return redirect()->route('currency.history');
        } catch (\Exception $e) {
            Log::info('ERROR: '.$e->getMessage());

            return back()->withErrors(['custom' => $e->getMessage()]);
        }
    }

    public function history(): \Inertia\Response
    {
        $listHistorycCurrency = Transaction::orderBy('created_at', 'desc')->get();

        return Inertia::render('History', [
            'listHistorycCurrency' => $listHistorycCurrency,
        ]);
    }
}
