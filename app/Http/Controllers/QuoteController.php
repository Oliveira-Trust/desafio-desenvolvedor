<?php

namespace App\Http\Controllers;

use App\Enum\PaymentMethod;
use App\Http\Requests\QuoteRequest;
use App\Mail\QuotationMail;
use App\Models\Quote;
use App\Models\TaxSettings;
use App\Services\AwesomeApiService;
use App\Services\QuotationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->get('sort')) {
            $request->merge(['sort' => ['key' => 'id', 'order' => 'desc']]);
        }

        $query = Quote::query()
            ->when($request->get('search'), function ($query, $search) {
                $search = strtolower(trim($search));
                return $query->whereRaw('LOWER(source_currency) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(target_currency) LIKE ?', ["%$search%"]);
            })
            ->when($request->get('sort'), function ($query, $sortBy) {
                return $query->orderBy($sortBy['key'], $sortBy['order']);
            });

        $quotations = $query->where('user_id', auth()->user()->id)->paginate($request->get('limit', 10));

        return inertia('Quote/Index', [
            'quotations' => $quotations,
        ]);
    }

    public function create()
    {
        $sourceCurrencies = [
            'BRL' => 'Real Brasileiro',
            'EUR' => 'Euro',
            'USD' => 'Dólar Americano',
            'BTC' => 'Bitcoin',
        ];
        $targetCurrencies = AwesomeApiService::getCurrencies();


        return inertia('Quote/Create', [
            'sourceCurrencies' => $sourceCurrencies,
            'targetCurrencies' => $targetCurrencies,
            'paymentMethods' => PaymentMethod::cases()
        ]);

    }

    public function quotation(Request $request)
    {
        if(!QuotationService::validateAvailability($request)){
            return response()->json([], 400);
        }
        $quotation = QuotationService::getQuotation($request);

        return response()->json($quotation);
    }

    public function store(QuoteRequest $request)
    {
        $request['user_id'] = auth()->user()->id;
        $quote = Quote::create($request->all());
        Mail::to(auth()->user()->email)->send(new QuotationMail($quote));
        return redirect()->back()->with('success', 'Cotação criada com sucesso!');
    }

    public function show(Quote $quote)
    {
    }

    public function edit($id)
    {
        $quote = Quote::find($id);
        return inertia('Quote/Edit', [
            'quote' => $quote,
            'sourceCurrencies' => [
                'BRL' => 'Real Brasileiro',
                'EUR' => 'Euro',
                'USD' => 'Dólar Americano',
                'BTC' => 'Bitcoin',
            ],
            'targetCurrencies' => AwesomeApiService::getCurrencies(),
            'paymentMethods' => PaymentMethod::cases()
        ]);
    }

    public function update(QuoteRequest $request, $id)
    {
        $quote = Quote::find($id);
        $quote->update($request->all());
        Mail::to(auth()->user()->email)->send(new QuotationMail($quote, 'Cotação Atualizada'));
        return redirect()->back()->with('success', 'Cotação atualizada com sucesso!');
    }

    public function destroy(Quote $quote)
    {
    }
}
