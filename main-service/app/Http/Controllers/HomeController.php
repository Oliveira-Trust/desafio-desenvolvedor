<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Jobs\QuotationCreatedJob;
use App\Services\CurrencyService;
use App\Services\PaymentMethodService;
use App\Services\QuotationService;
use Illuminate\Support\Facades\Auth;
use Phalcon\Exception;

class HomeController extends Controller
{
    protected $currencyService;
    protected $quotationService;
    protected $paymentMethodService;

    public function __construct(
        CurrencyService $currencyService,
        QuotationService $quotationService,
        PaymentMethodService $paymentMethodService
    )
    {
        $this->currencyService = $currencyService;
        $this->quotationService = $quotationService;
        $this->paymentMethodService = $paymentMethodService;
    }

    public function index()
    {
        $currencies = $this->currencyService->getAllActiveCurrencies();
        $paymentMethods = $this->paymentMethodService->getAllActivePaymentMethods();
        return view('home.index', compact('currencies', 'paymentMethods'));
    }

    public function quotation(QuotationRequest $request)
    {
        try {
            $result = $this->quotationService->getQuotation($request->validated());

            //Send quotation result to Email Microservice throw RabbitMQ
            QuotationCreatedJob::dispatch($result)->onQueue('queue_email');

            return view('home.resultquotation', compact('result'));
        } catch (\Exception $e) {
            return redirect()->route('index')->with('message', 'Não foi possível realizar a cotação. Por favor, verifique sua internet.');
        }


    }

    public function getAllQuotationsByUser()
    {
        $quotations = $this->quotationService->getAllQuotationsByUserAuthenticated();

        return view('home.historicQuotationsByUser', compact('quotations'));
    }

    public function getAllQuotations()
    {
        $quotations = $this->quotationService->getAllQuotations();

        return view('home.historicquotations', compact('quotations'));
    }
}
