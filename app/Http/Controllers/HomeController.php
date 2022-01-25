<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\QuoteGenerateFormRequest;
use App\Services\QuoteService;
use AwesomeApi\Services\AwesomeApiService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    private AwesomeApiService $awesomeApiService;
    private QuoteService $quoteService;

    public function __construct(AwesomeApiService $awesomeApiService, QuoteService $quoteService)
    {
        $this->awesomeApiService = $awesomeApiService;
        $this->quoteService = $quoteService;
    }

    public function index(): Renderable
    {
        return view('home')->with('data', $this->awesomeApiService->currenciesAvailable());
    }

    public function quoteHistory(): Renderable
    {
        $quotes = $this->quoteService->getQuoteHistory();
        return view('quote-history', compact('quotes'));
    }

    public function generateQuote(QuoteGenerateFormRequest $request): JsonResponse
    {
        $data = $this->quoteService->quoteGenerate($request->validated());
        return response()->json($data, Response::HTTP_OK);
    }

    public function sendInEmail(): JsonResponse
    {
        $this->quoteService->sendEmail();
        return response()->json([], 200);
    }
}
