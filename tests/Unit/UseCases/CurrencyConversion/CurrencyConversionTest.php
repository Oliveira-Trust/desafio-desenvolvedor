<?php

namespace Tests\Feature\UseCases\CurrencyConversion;

use App\Dtos\CurrencyConversionDto;
use App\Enum\CurrencyEnum;
use App\Enum\PaymentMethodEnum;
use App\UseCases\CurrencyConversion\CurrencyConversionUseCase;
use Tests\TestCase;
use Tests\Traits\EconomiaAwesomeApiMock;

class CurrencyConversionTest extends TestCase
{
    use EconomiaAwesomeApiMock;

    public function testExecuteSuccessfulConversionCreditCard(): void
    {
        $origin = CurrencyEnum::BRL;
        $target = CurrencyEnum::from(fake()->randomElement(CurrencyEnum::convertable()));
        $conversionValue = 1000 * 100;
        $paymentMethod = PaymentMethodEnum::CREDIT_CARD;

        $data = $this->mockCurrencyConversionData($origin->value, $target->value);
        $repository = $this->mockCurrencyConversionContractRepository($data);

        $conversionDto = new CurrencyConversionDto(
            origin: $origin,
            target: $target,
            conversionValue: $conversionValue,
            paymentMethod: $paymentMethod,
        );

        $useCase = new CurrencyConversionUseCase($repository);
        $result = $useCase->execute([$conversionDto]);

        $this->assertCount(1, $result);
        $this->assertEquals($paymentMethod, $result[0]->getPaymentMethod());
        $this->assertEquals(2000, $result[0]->getConversionTax());
        $this->assertEquals(7630, $result[0]->getPaymentTax());
        $this->assertEquals($conversionValue - 2000 - 7630, $result[0]->getConvertableValue());
    }

    public function testExecuteSuccessfulConversionBankBillet(): void
    {
        $origin = CurrencyEnum::BRL;
        $target = CurrencyEnum::from(fake()->randomElement(CurrencyEnum::convertable()));
        $conversionValue = 1000 * 100;
        $paymentMethod = PaymentMethodEnum::BANK_BILLET;

        $data = $this->mockCurrencyConversionData($origin->value, $target->value);
        $repository = $this->mockCurrencyConversionContractRepository($data);

        $conversionDto = new CurrencyConversionDto(
            origin: $origin,
            target: $target,
            conversionValue: $conversionValue,
            paymentMethod: $paymentMethod,
        );

        $useCase = new CurrencyConversionUseCase($repository);
        $result = $useCase->execute([$conversionDto]);

        $this->assertCount(1, $result);
        $this->assertEquals($paymentMethod, $result[0]->getPaymentMethod());
        $this->assertEquals(2000, $result[0]->getConversionTax());
        $this->assertEquals(1450, $result[0]->getPaymentTax());
        $this->assertEquals($conversionValue - 2000 - 1450, $result[0]->getConvertableValue());
    }
}
