<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExchangeService;
use Illuminate\Support\Facades\Log;
use Exception;


class ExchangeController extends Controller
{

    protected $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index($codeCoin = 'BRL')
    {
        $availableExchanges = $this->exchangeService->getAvailableExchanges($codeCoin);

        if ($availableExchanges['status'] !== 'success') {
            return view('dashboard')->with('error', $availableExchanges['message']);
        }

        $exchangeRatesWithNames = $this->exchangeService->getExchangeRates($availableExchanges['data']);

        if ($exchangeRatesWithNames['status'] !== 'success') {
            return view('dashboard')->with('error', $exchangeRatesWithNames['message']);
        }

        $exchangeRates = $exchangeRatesWithNames['data'];


        return view('dashboard', [
            'exchangeDetails' => $exchangeRates,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (!$request->has('transaction')) {
            return redirect()->route('dashboard')->with(['error' => 'Erro ao realizar cotação.']);
        }

        $transaction = [
            0 => $request->query('transaction')
        ];
        $exchangeRate = $this->exchangeService->getExchangeRates($transaction);

        if ($exchangeRate['status'] !== 'success') {
            return redirect()->route('dashboard')->with(['error' => 'Erro ao realizar cotação.']);
        }

        // Reorganizar os dados para que "data" contenha diretamente as informações da moeda
        $exchangeDetails = array_values($exchangeRate['data'])[0];

      

        return view('exchange.exchange', [
            'exchangeDetails' => $exchangeDetails,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
