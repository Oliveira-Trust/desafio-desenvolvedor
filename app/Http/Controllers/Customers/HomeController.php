<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\ExchangePurchaseSetupRepository;
use App\Repositories\Customer\TaxRepository;
use ExchangeRate\ClientExchange;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var ExchangePurchaseSetupRepository
     */
    private $exchangePurchaseSetupRepository;
    /**
     * @var TaxRepository
     */
    private $taxRepository;

    /**
     * @param ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository
     * @param TaxRepository $taxRepository
     */
    public function __construct(ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository, TaxRepository $taxRepository)
    {
        $this->exchangePurchaseSetupRepository = $exchangePurchaseSetupRepository;
        $this->taxRepository = $taxRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = auth()->user()->customer;
        $exchanges = $customer->exchanges()->orderBy('created_at', 'desc')->paginate(5);
        return view('customers.exchange-list', ['exchanges' => $exchanges]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function exchangeRate()
    {

        $currencies = ClientExchange::getCurrenciesList();
        ksort($currencies);
        $purchaseInterval = $this->getIntervalPurchaseInterval();
        return view('customers.index', ['calc' => '', 'currenciesFrom' => $currencies, 'currenciesTo' => $currencies, 'purchaseInterval' => $purchaseInterval]);
    }

    /**
     * @return object
     */
    protected function getIntervalPurchaseInterval()
    {
        // pega o último setup criado
        $setup = $this->exchangePurchaseSetupRepository->orderBy('created_at', 'desc')->first();
        $purchaseValue = $this->taxRepository->getModel()->where([['setup_id', '=', $setup->id], ['name', '=', 'valor_da_compra']])->first();
        return $purchaseValue->interval()->first();

    }
}
