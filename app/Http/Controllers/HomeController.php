<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuoteGenerateFormRequest;
use App\Services\PaymentService;
use AwesomeApi\Services\AwesomeApiService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
        return view('home')->with('data', $this->awesomeApiService->currenciesAvailable());
    }

    public function generateQuote(QuoteGenerateFormRequest $request): JsonResponse
    {
        $data = $this->paymentService->quoteGenerate($request->validated());
        return response()->json($data, Response::HTTP_OK);
    }

    public function quoteHistory(): Renderable
    {
        return view('quote-history');
    }
}
