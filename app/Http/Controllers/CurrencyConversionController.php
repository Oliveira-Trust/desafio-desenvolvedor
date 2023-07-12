<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversion\getByUserIdRequest;
use App\Http\Requests\CurrencyConversion\RegisterCurrencyConversionRequest;
use App\Services\ApiExternal\aweSomeApiService;
use App\Services\ConversionFee\ConversionFeeService;
use App\Services\CurrencyConversion\CurrencyConversionServiceContract;
use App\Services\PaymentFee\PaymentFeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Currency Conversions
 *
 * API endpoints for currency conversions.
 */

class CurrencyConversionController extends Controller
{
    protected $currencyConversionService;
    protected $paymentFeeService;
    protected $conversionFeeService;
    protected $aweSomeApiService;

    public function __construct(
        CurrencyConversionServiceContract $currencyConversionServiceContract,
        PaymentFeeService $paymentFeeService,
        ConversionFeeService $conversionFeeService,
        aweSomeApiService $aweSomeApiService
    ) {
        $this->currencyConversionService = $currencyConversionServiceContract;
        $this->paymentFeeService = $paymentFeeService;
        $this->conversionFeeService = $conversionFeeService;
        $this->aweSomeApiService = $aweSomeApiService;
    }


    /**
     * Convert currency.
     *
     * Converts a given currency value from the source currency to the target currency.
     *
     * @bodyParam conversion_value number required The value to convert.
     * @bodyParam payment_type number required The payment type (1 for boleto, 2 for card).
     * @bodyParam target_currency string required The target currency.
     *
     * @response {
     *     "id": 1,
     *     "conversion_value": 100.00,
     *     "payment_type": 1,
     *     "source_currency": "BRL",
     *     "target_currency": "USD",
     *     "value_target_currency": 50.00,
     *     "value_payment_fee": 2.00,
     *     "value_conversion_fee": 5.00,
     *     "purchased_value": 1.90,
     *     "value_conversion_deductiong_fee": 92.10,
     *     "user_id": 1,
     *     "created_at": "2023-07-10 12:34:56",
     *     "updated_at": "2023-07-10 12:34:56"
     * }
    
     */
    public function currencyConversion(RegisterCurrencyConversionRequest $request)
    {
        try {
            $data = $request->validated();
            $valuePaymentFee = $this->paymentFeeService->calculatePaymentFee($data['conversion_value'], $data['payment_type']);
            $valueConversionFee = $this->conversionFeeService->calculateConversionFee($data['conversion_value']);
            $valueTargetCurrency = $this->currencyConversionService->getValueTargetCurrency('BRL',  $data['target_currency']);
            $conversionValue = $data['conversion_value'];
            $params = [
                'conversionValue' => $conversionValue,
                'valueConversionFee' => $valueConversionFee,
                'valuePaymentFee' => $valuePaymentFee,
                'valueTargetCurrency' => $valueTargetCurrency
            ];

            $dataCurrencyConversion = [
                'source_currency' => 'BRL',
                'target_currency' => $data['target_currency'],
                'conversion_value' => $data['conversion_value'],
                'payment_type' => $data['payment_type'],
                'value_target_currency' => $valueTargetCurrency,
                'purchased_value' => $this->currencyConversionService->getPurchasedValue($params),
                'value_payment_fee' => $valuePaymentFee,
                'value_conversion_fee' => $valueConversionFee,
                'value_conversion_deductiong_fee' => $this->currencyConversionService->getValueConversionDeductiongFee($params),
                'user_id' => Auth::user()->id,
            ];

            $this->currencyConversionService->store($dataCurrencyConversion);
            return view('registercurrencyconversion', ['data' => $dataCurrencyConversion]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error. Please try again later.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Get currency conversion history.
     *
     * Retrieves the conversion history for the authenticated user.
     *
     * @queryParam per_page number The number of results per page. Defaults to 10.
     * @queryParam order_by string The field to order the results by. Defaults to 'created_at'.
     * @queryParam order_direction string The order direction ('asc' or 'desc'). Defaults to 'desc'.
     *
     * @response {
     *     "data": [
     *         {
     *             "id": 1,
     *             "conversion_value": 100.00,
     *             "payment_type": 1,
     *             "source_currency": "BRL",
     *             "target_currency": "USD",
     *             "value_target_currency": 50.00,
     *             "value_payment_fee": 2.00,
     *             "value_conversion_fee": 5.00,
     *             "purchased_value": 1.90,
     *             "value_conversion_deductiong_fee": 92.10,
     *             "user_id": 1,
     *             "created_at": "2023-07-10 12:34:56",
     *             "updated_at": "2023-07-10 12:34:56"
     *         }
     *     ]
     * }
     *
     * 
     */

    public function historyCotationCurrency(Request $request)
    {
        try {
            $userId = Auth::user()->id;
            $perPage = $request->get('per_page') ?? 10;
            $orderBy = $request->get('order_by') ?? 'created_at';
            $orderDirection = $request->get('order_direction') ?? 'desc';

            $dataHistoryCotationCurrency = $this->currencyConversionService->getByUserId($userId, $perPage, $orderBy, $orderDirection);

            return view('historycurrencyconversion', ['data' => $dataHistoryCotationCurrency]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error. Please try again later.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
