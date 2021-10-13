<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusType;
use App\HttpClient\HttpClientsInterface;
use App\Models\Currency;
use App\Models\Quotation;
use App\Repositories\Contracts\QuotationRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class QuotationService
{
    protected $feeService;
    protected $httpClient;
    protected $currencyService;
    protected $paymentMethodService;
    protected $quotationRepository;

    public function __construct(
        FeeService $feeService,
        HttpClientsInterface $httpClient,
        CurrencyService $currencyService,
        PaymentMethodService $paymentMethodService,
        QuotationRepositoryInterface $quotationRepository

    ) {
        $this->feeService = $feeService;
        $this->httpClient = $httpClient;
        $this->currencyService = $currencyService;
        $this->paymentMethodService = $paymentMethodService;
        $this->quotationRepository = $quotationRepository;
    }

    public function storeNewQuotation(array $data) : Quotation
    {
        return $this->quotationRepository->store($data);
    }

    public function getAllQuotations() : array
    {
        return $this->quotationRepository->relationships('user')->getAll()->toArray();
    }

    public function getAllQuotationsByUserAuthenticated() : array
    {
        return $this->quotationRepository->findWhere('user_id', Auth::id())->toArray();
    }

    public function getQuotationById(int $id) : Quotation
    {
        return $this->quotationRepository->findById($id);
    }

    public function getQuotation(array $request) : array
    {
        $methodId           = (int)$request['method'];
        $currencyId         = (int)$request['currency'];
        $amount             = convertStringToFloat($request['amount']);
        $toCurrencyCode     = $this->currencyService->getCurrencyObj($currencyId)->getCode();
        $paymentMethodName  = $this->paymentMethodService->getPaymentMethodObj($methodId)->getMethod();
        $defaultCurrency    = Currency::DEFAULT_CURRENCY;

        $paymentFeeCalculated = $this->paymentFeeCalculated($methodId, $amount);
        $conversionFeeCalculated = $this->conversionFeeCalculated($amount);

        /**
         * Value used for conversion discounting the fees
         */
        $newAmount = $amount - $paymentFeeCalculated - $conversionFeeCalculated;

        $url = config('api.URL_API_CURRENCY') . $toCurrencyCode . "-" . $defaultCurrency;
        $quotationValues = $this->getQuotationFromApi($url);
        $quotation = $quotationValues["{$toCurrencyCode}{$defaultCurrency}"]['high'];

        $amountConverted = $newAmount / $quotation;

        $result['from_currency']     = 'BRL';
        $result['user_id']           = Auth::id();
        $result['user_name']         = Auth::User()->name;
        $result['user_email']        = Auth::User()->email;
        $result['to_currency']       = strtoupper($toCurrencyCode);
        $result['amount']            = number_format($amount,2,',','.');
        $result['payment_method']    = $paymentMethodName;
        $result['quotation']         = number_format((float)$quotation,4,',','.');
        $result['amount_converted']  = number_format($amountConverted,2,',','.');
        $result['payment_fee']       = number_format($paymentFeeCalculated,2,',','.');
        $result['conversion_fee']    = number_format($conversionFeeCalculated,2,',','.');
        $result['new_amount']        = number_format($newAmount,2,',','.');

        $this->storeNewQuotation($result);

        return $result;
    }

    public static function rangeNumber($value) : bool
    {
        //Verify if is number
        $expressao = "/^([1-9]{1}[\d]{0,2}(\.[\d]{3})*(\,[\d]{0,2})?|[1-9]{1}[\d]{0,}(\,[\d]{0,2})?|0(\,[\d]{0,2})?|(\,[\d]{1,2})?)$/";
        $regex = (preg_match($expressao,$value));
        if ($regex === 0) {
            return false;
        }

        //Verify range between 1.000,00 e 100.000,00
        $number = convertStringToFloat($value);
        return !($number < 1000 || $number > 100000);
    }

    protected function paymentFeeCalculated(int $methodId, float $amount): float
    {
        $paymentMethod    = $this->paymentMethodService->getPaymentMethodObj($methodId);
        $paymentMethodFee = $paymentMethod->getFee();

        return  $amount * $paymentMethodFee / 100;
    }

    protected function conversionFeeCalculated(float $amount): float
    {
        $conversionFee = $this->getConversionFee($amount);

        return $amount * $conversionFee / 100;
    }

    /**
     * Return Conversion Fee from Actived Fee
     * Exists only one Actived Fee in Database
     */
    protected function getConversionFee(float $amount): float
    {
        $fee = $this->feeService->getFeeObj(StatusType::ACTIVATED);
        if($amount <= $fee->getRange()) {
            return $fee->getLessThan();
        }

         return $fee->getMoreThan();
    }

    /**
     * Get Currency Quotation from external API or from Cache
     * Each cache expires in 60 seconds
     */
    protected function getQuotationFromApi(string $url) : array
    {
        try{
            return Cache::remember($url, config('api.CACHE_LIFETIME'), function () use ($url) {
                return $this->httpClient->startHttpClient($url, 'GET');
            });
        } catch (\Exception $e) {
            $error_msg = $e->getMessage();
            throw new \Exception($error_msg);
        }
    }
}
