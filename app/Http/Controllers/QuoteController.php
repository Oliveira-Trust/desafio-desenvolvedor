<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\Quote\QuoteServiceInterface;
use App\Helpers\ApiResponse;

class QuoteController extends Controller
{
    protected $quoteService;

    public function __construct(QuoteServiceInterface $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function getAvailableCurrencies(string $origin)
    {
        $currencies = $this->quoteService->getAvailableCurrencies($origin);
        return ApiResponse::sendResponse($currencies, 'Available currencies retrieved successfully.', 200);
    }

    public function generateCurrencyQuote(Request $request,string $origin, string $destination)
    {
        $data = $request->only(['value', 'type']);
        $data['value'] = $data['value'] ?? 0; 
        $data['type'] = $data['type'] ?? 'none'; 
        try {
            $quote = $this->quoteService->generateCurrencyQuote($origin, $destination, $data['value'], $data['type']);
            return ApiResponse::sendResponse($quote, 'Currency quote generated successfully.',200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e,$e->getMessage());
        }
    }

    public function changeQuoteRates(Request $request, string $userId)
    {
        $rates = $request->input('rates');
        $this->quoteService->changeQuoteRates($userId, $rates);
        return ApiResponse::sendResponse(null, 'Quote rates changed successfully.', 200);
    }

    public function sendQuoteByEmail(Request $request, string $userId)
    {
        $email = $request->input('email');
        $this->quoteService->sendQuoteByEmail($userId, $email);
        return ApiResponse::sendResponse(null, 'Quote sent by email successfully.', 200);
    }
}