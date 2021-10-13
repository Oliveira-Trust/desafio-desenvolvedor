<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\HttpClient\CurlHttpClient;
use App\Models\Quotation;
use App\Services\CurrencyService;
use App\Services\FeeService;
use App\Services\PaymentMethodService;
use App\Services\QuotationService;
use Illuminate\Support\Facades\Cache;
use Tests\Feature\Traits\CreateModels;
use Tests\TestCase;

class QuotationServiceTest extends TestCase
{
    use CreateModels;

    protected function setUp(): void
    {
        parent::setUp();
        $this->feeService = app(FeeService::class);
        $this->currencyService = app(CurrencyService::class);
        $this->quotationService = app(QuotationService::class);
        $this->paymentMethodService = app(PaymentMethodService::class);
        $this->httpClient = app(CurlHttpClient::class);
    }

    public function test_get_all_cotations(): void
    {
        $fee = Quotation::factory(3)->create();
        $result = $this->quotationService->getAllQuotations();

        $this->assertCount(3, $result);
    }

    public function test_find_quotation_by_id(): void
    {
        $this->createAuthenticatedUser();
        $this->createQuotation();

        $result = $this->quotationService->getQuotationById(1);

        $this->assertEquals("PIX", $result->payment_method);
    }

    public function test_store_quotation(): void
    {
        $this->createAuthenticatedUser();

        $quotationParams = [
            'user_id'           => 1,
            'from_currency'     => "BRL",
            'to_currency'       => "USD",
            'amount'            => 5000,
            'payment_method'    => 'Boleto',
            "payment_fee"       => 72.5,
            "conversion_fee"    => 50.00,
            "new_amount"        => 4877.5,
            "quotation"         => 5.5321,
            "amount_converted"  => 881.67,
        ];
        $quotation = $this->quotationService->storeNewQuotation($quotationParams);
        $result = $this->quotationService->getQuotationById($quotation->id);

        $this->assertEquals(881.67, $result->amount_converted);
    }

    public function test_range_number_value_is_not_number(): void
    {
        $value = "abcd";
        $result = $this->quotationService->rangeNumber($value);
        $value = "R$ 123.00,00";
        $result2 = $this->quotationService->rangeNumber($value);

        $this->assertFalse($result);
        $this->assertFalse($result2);
    }

    public function test_range_number_is_between_1000_100000(): void
    {
        $value = "1.001,00";
        $result = $this->quotationService->rangeNumber($value);
        $value = "99.999,99";
        $result2 = $this->quotationService->rangeNumber($value);
        $this->assertTrue($result);
        $this->assertTrue($result2);
    }

    public function test_range_number_is_not_between_1000_100000(): void
    {
        $value = "999,00";
        $result = $this->quotationService->rangeNumber($value);
        $value = "100.001,00";
        $result2 = $this->quotationService->rangeNumber($value);
        $this->assertFalse($result);
        $this->assertFalse($result2);
    }

    /**
     * @dataProvider formParamsFromUserProvider
     * 2% Fee to convert amount less than 3000 and 1% Fee to convert amount more than 3000
     * 1.45% Fee for payment from Boleto ane 7.63% for payment from Credit Card
     */
    public function test_get_quotation_brl_to_usd(
        $paymentMethod, $stringAmount, $floatAmount, $conversionFee, $paymentMethodFee
    ): void {
        $this->createBoletoPaymentMethod();
        $this->creditCardPaymentMethod();
        $this->createCurrency();
        $this->createFee();
        $this->createAuthenticatedUser();

        $params = [
            'method'    => $paymentMethod,
            'amount'    => $stringAmount,
            'currency'  => 1
        ];

        $result = $this->quotationService->getQuotation($params);

        $url = config('api.URL_API_CURRENCY') . "USD-BRL";
        $quotationValues = $this->getCurrencyCotationFromApi($url);
        $quotation = $quotationValues["USDBRL"]['high'];

        $conversionFeeCalculated = $floatAmount * $conversionFee / 100;
        $paymentFeeCalculated = $floatAmount * $paymentMethodFee / 100;
        $newAmount = $floatAmount - $paymentFeeCalculated - $conversionFeeCalculated;

        $amountConverted = $newAmount / $quotation;

        $this->assertEquals('BRL', $result['from_currency']);
        $this->assertEquals('USD', $result['to_currency']);
        $this->assertEquals($this->numberFormat((float)$quotation, 4), $result['quotation']);
        $this->assertEquals($this->numberFormat($amountConverted, 2), $result['amount_converted']);
        $this->assertEquals($this->numberFormat($paymentFeeCalculated, 2), $result['payment_fee']);
        $this->assertEquals($this->numberFormat($conversionFeeCalculated, 2), $result['conversion_fee']);
        $this->assertEquals($this->numberFormat($newAmount, 2), $result['new_amount']);
    }

    public function getCurrencyCotationFromApi(string $url): array
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

    public function numberFormat(float $number, int $decimals): string
    {
        return number_format($number,$decimals,',','.');
    }

    /**
     * DataProvider represent the values sent from Users
     * paymentMethod, stringAmount, floatAmount, conversionFee, paymentMethodFee
     */
    public function formParamsFromUserProvider(): array
    {
        return [
          [1, '5.000,00', 5000, 1, 1.45],
          [2, '5.000,00', 5000, 1, 7.63],
          [1, '2.730,00', 2730, 2, 1.45],
          [2, '2.730,00', 2730, 2, 7.63],
        ];
    }
}
