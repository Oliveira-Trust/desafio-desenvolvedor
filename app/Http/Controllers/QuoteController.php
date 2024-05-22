<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\Quote\QuoteServiceInterface;
use App\Interface\Quote\HistoricalQuoteInterface;
use App\Interface\User\UserInterface;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\generateCurrencyQuoteRequest;
use App\Http\Requests\changeQuoteRatesRequest;
use Illuminate\Support\Facades\Validator;
use App\Rules\isDestination;
class QuoteController extends Controller
{
    protected $quoteService;
    protected $userInterface;
    protected $historicalQuoteInterface;
    public function __construct(QuoteServiceInterface $quoteService, UserInterface $userInterface, HistoricalQuoteInterface $historicalQuoteInterface)
    {
        $this->quoteService = $quoteService;
        $this->userInterface = $userInterface;
        $this->historicalQuoteInterface = $historicalQuoteInterface;
    }

    public function getAvailableCurrencies(string $origin)
    {
        try {
        $currencies = $this->quoteService->getAvailableCurrencies($origin);
        return ApiResponse::sendResponse($currencies, 'Available currencies retrieved successfully.', 200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e,$e->getMessage());
        }
    }

    public function generateCurrencyQuote(generateCurrencyQuoteRequest $request,string $origin, string $destination)
    {
        $validator = Validator::make(compact('origin', 'destination'), [
            'origin' => ['required', 'string', 'between:3,8', 'in:BRL' ,'different:destination'],
            'destination' => ['required', 'string', 'between:3,8', 'different:origin', new isDestination($origin,$this->quoteService)],
        ]);

        if ($validator->fails()) {
            return ApiResponse::throw(null, $validator->errors(), 400);
        }

        $data = $request->only(['value', 'type']); 

        try {
            $quote = $this->quoteService->generateCurrencyQuote($origin, $destination, $data['value'], $data['type']);
            $this->quoteService->sendQuoteByEmail(Auth::user()->id, $quote);
            return ApiResponse::sendResponse($quote, 'Currency quote generated successfully.',200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e,$e->getMessage());
        }
    }

    public function getQuoteTaxes()
    {
        try {
            $taxes = $this->userInterface->getUserConfigTax(Auth::user()->id, '');
            return ApiResponse::sendResponse($taxes, 'Quote taxes retrieved successfully.', 200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e, $e->getMessage());
        }
    }

    public function getHistoricalQuotes()
    {
        try {
            $quotes = $this->historicalQuoteInterface->index(Auth::user()->id);
            return ApiResponse::sendResponse($quotes, 'Historical quotes retrieved successfully.', 200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e, $e->getMessage());
        }
    }

    public function changeQuoteRates(Request $request)
    {
        try {
            $taxes = $request->input('configs');

            $paymentMethods = array_column($taxes, 'payment_method');
            $uniqueMethods = array_unique($paymentMethods);
            
            if (count($paymentMethods) !== count($uniqueMethods)) {
                return ApiResponse::throw(null,'Validation Error: Payment methods must be unique.', 422);
            }

            $this->userInterface->updateUserConfigTax(Auth::user()->id, $taxes);
            
            return ApiResponse::sendResponse(null, 'Quote rates changed successfully.', 200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e, $e->getMessage());
        }
    }
}