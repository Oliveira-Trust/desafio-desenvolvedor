<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuoteGenerateFormRequest;
use App\Services\PaymentService;
use AwesomeApi\Services\AwesomeApiService;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    private AwesomeApiService $awesomeApiService;
    private PaymentService $paymentService;

    public function __construct(AwesomeApiService $awesomeApiService, PaymentService $paymentService)
    {
        $this->awesomeApiService = $awesomeApiService;
        $this->paymentService = $paymentService;
    }

    public function index(): Renderable
    {
        return view('home')
            ->with(
                'data',
                $this->awesomeApiService->currenciesAvailable()
            );
    }

    public function generateQuote(QuoteGenerateFormRequest $request)
    {
        $this->paymentService->quoteGenerate($request->validated());
    }

    public function quoteHistory(): Renderable
    {
        return view('quote-history');
    }
}
