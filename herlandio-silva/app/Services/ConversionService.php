<?php

namespace App\Services;

use GuzzleHttp\Client;

class ConversionService {
    
    private const BASE          = 'https://economia.awesomeapi.com.br/json/last/';
    private const CREDIT_CARD   = "credit_card";
    private const TICKET        = "ticket";

    /**
     * The function is a PHP constructor that initializes a protected property with a Client object.
     */
    public function __construct(
        protected Client $client
    ) {
        $this->client = $client;
    }

    /**
     * This PHP function retrieves exchange rates for specified currencies using an API request.
     * 
     * @param string currencies The `getExchangeRates` function is used to retrieve exchange rates for
     * the specified currencies. The `currencies` parameter is a string that represents the currencies
     * for which you want to retrieve exchange rates.
     * 
     * @return The function `getExchangeRates` is returning an array of exchange rates for the
     * specified currencies. The exchange rates are fetched from an external API using a GET request
     * and then decoded from JSON format to an associative array before being returned.
     */
    public function getExchangeRates(string $currencies)
    {
        $response = $this->client->request('GET', static::BASE.$currencies, [
            'verify' => false
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Erro ao buscar taxas de câmbio');
        }

        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

    /**
     * The function calculates exchange rates based on the provided currencies and returns the bid
     * rate.
     * 
     * @param request The `calcExchangeRates` function takes a `` parameter which seems to be
     * an object containing information about the currencies involved in the exchange rate calculation.
     * The object likely has properties like `to_currency` and `from_currency` which are used to
     * determine the exchange rate bid value between the two currencies
     * 
     * @return The function `calcExchangeRates` is returning the bid exchange rate for the specified
     * currencies in the request.
     */
    public function calcExchangeRates($request) {
        try {
            $fromTo     = "{$request->to_currency}-{$request->from_currency}";
            $currencies = $request->to_currency.$request->from_currency;
            $rates      = $this->getExchangeRates($fromTo);
            return $rates[$currencies]["bid"];
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * The calcFee function calculates a fee based on a percentage of a given result and adds it to the
     * result.
     * 
     * @param result The `result` parameter in the `calcFee` function represents the initial value
     * before any fee calculation is applied.
     * @param fee The `fee` parameter in the `calcFee` function represents the percentage of the
     * `result` that will be added as a fee. It is used to calculate the total fee amount based on the
     * `result` value.
     * 
     * @return The function `calcFee` is returning the result after adding the calculated fee to it.
     */
    public function calcFee($result, $fee)
    {
        $total = ($fee/100) * $result;
        $result = $result + $total;
        return $result;
    }

    /**
     * The functions calculate fees based on payment method and amount without payment type.
     * 
     * @param request The `calcfeeWithoutPaymentType` function calculates the fee based on the amount
     * in the request object. If the amount is less than 3000, it calls the `calcFee` method with a fee
     * of 2 from the `resultExchangeRates`, otherwise it calls the `calcFee`
     * @param resultExchangeRates  is a variable that likely contains exchange
     * rates for different currencies. It is used in the calcfeeWithoutPaymentType function to
     * calculate fees based on the amount provided in the request.
     * 
     * @return The `calcTotalFeeByTypePayment` function is returning the result of a match expression
     * based on the `payment_method` value from the `` object. If the `payment_method` is
     * `CREDIT_CARD`, it will calculate the fee by calling `calcFee` with the `feeWithoutPaymentType`
     * and 7.63 as arguments. If the `payment_method` is `
     */
    public function calcfeeWithoutPaymentType($request, $resultExchangeRates) 
    {
        return $request->amount < 3000 
            ? $this->calcFee($resultExchangeRates, 2) 
            : $this->calcFee($resultExchangeRates, 1);
    }

    public function calcTotalFeeByTypePayment($request, $feeWithoutPaymentType) {
        return match($request->payment_method) {
            static::CREDIT_CARD => $this->calcFee($feeWithoutPaymentType, 7.63),
            static::TICKET => $this->calcFee($feeWithoutPaymentType, 1.45)
        };
    }
}
