<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\Quote\QuoteServiceInterface;
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
    public function __construct(QuoteServiceInterface $quoteService, UserInterface $userInterface)
    {
        $this->quoteService = $quoteService;
        $this->userInterface = $userInterface;
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

    public function changeQuoteRates(changeQuoteRatesRequest $request)
    {
        try {
            $taxes = $request->input('configs');
            $this->userInterface->updateUserConfigTax(Auth::user()->id, $taxes);
            return ApiResponse::sendResponse(null, 'Quote rates changed successfully.', 200);
        } catch (\Exception $e) {
            return ApiResponse::throw($e, $e->getMessage());
        }
    }
}