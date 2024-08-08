<?php

namespace App\helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Exception;

class Currency
{
    private mixed $config;

    public function __construct() {
        $configArray = require '../config/config.php';
        $this->config = $configArray;
    }

    public function convertCurrency(
        string $destinyCoin,
        float $amount,
        string $paymentMethod
    ): ?array {
        try {
            $currentPrice = self::getCurrentPrice($destinyCoin);
            $totalTax = self::applyTax($destinyCoin, $amount, $paymentMethod);
            $paramResponse = self::getTheCorrectResponse($destinyCoin);
            $liquidValues = self::getLiquidValues($amount, $totalTax['tax_payment'], $totalTax['tax_convert'], $currentPrice[$paramResponse]['bid']);

            return [
                'success' => true,
                'originalCoin' => 'BRL',
                'destinyCoin' => $currentPrice[$paramResponse]['code'],
                'amount' => $amount,
                'paymentMethod' => $paymentMethod,
                'bid' => $currentPrice[$paramResponse]['bid'],
                'purchasedValue' => $liquidValues['liquid_amount_destiny_coin'],
                'paymentTax' => $totalTax['tax_payment'],
                'convertTax' => $totalTax['tax_convert'],
                'liquidValue' => $liquidValues['liquid_amount_brl']
            ];
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    private function getCurrentPrice(string $destinyCoin) {
        $url = $this->config['api_url'];
        $client = new Client();
        $coinConvert = self::getTheCorrectParameter($destinyCoin);

        if(empty($coinConvert)) {
            echo 'Invalid Coin';
            return null;
        }

        $url = $url . $coinConvert;

        try {
            $response = $client->request('GET', $url);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                echo $e->getResponse()->getBody()->getContents();
            } else {
                echo $e->getMessage();
            }
            return null;
        } catch (GuzzleException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    private function getTheCorrectParameter(string $destinyCoin): string {
        return match ($destinyCoin) {
            'USD' => 'USD-BRL',
            'EUR' => 'EUR-BRL',
            'BTC' => 'BTC-BRL',
            default => ''
        };
    }

    private function getTheCorrectResponse(string $destinyCoin): string {
        return match ($destinyCoin) {
            'USD' => 'USDBRL',
            'EUR' => 'EURBRL',
            'BTC' => 'BTCBRL',
            default => ''
        };
    }

    private function applyTax(
        string $destinyCoin,
        float $amount,
        string $paymentMethod
    ): ?array
    {
        try {
            $correctResponseCoin = $this->getTheCorrectResponse($destinyCoin);

            if(empty($correctResponseCoin)) {
                echo 'Invalid Coin';
                return null;
            }

            $taxPayment = match ($paymentMethod) {
                'bankSlip' => 1.45,
                'creditCard' => 7.63,
                default => ''
            };

            if(empty($taxPayment)) {
                echo 'Invalid Payment';
                return null;
            }

            $taxPaymentValue = $amount * ($taxPayment / 100);

            $taxConvert = $amount > 3000 ? 1 : 2;

            $taxConvertValue = $amount * ($taxConvert / 100);

            return [
                'tax_payment' => $taxPaymentValue,
                'tax_convert' => $taxConvertValue
            ];
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    private function getLiquidValues(
        float $amount,
        float $paymentTax,
        float $convertTax,
        float $bid
    ): ?array
    {
        try {
            $liquidAmountBRL = $amount - $paymentTax - $convertTax;

            $liquidAmountDestinyCoin = $liquidAmountBRL / $bid;

            return [
              'liquid_amount_brl' => $liquidAmountBRL,
              'liquid_amount_destiny_coin' => $liquidAmountDestinyCoin
            ];
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}