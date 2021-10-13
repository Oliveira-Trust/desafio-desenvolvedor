<?php

declare(strict_types=1);

namespace Tests\Feature\Traits;

use App\Enums\StatusType;
use App\Models\User;

trait CreateModels
{
    protected function createUser(): void
    {
        $userParams = [
            "name"      => "Juninho Pernambucano",
            "email"     => "email@email.com",
            "role"      => 'admin',
            "password"  => bcrypt('secret'),
        ];
        $user = $this->userService->storeNewUser($userParams);
    }

    protected function createBoletoPaymentMethod(): void
    {
        $methodsParams = [
            "method" => "Boleto Bancário",
            "fee" => 1.45,
            "status" => StatusType::ACTIVATED,
        ];
        $paymentMethod = $this->paymentMethodService->storePaymentMethod($methodsParams);
    }

    protected function creditCardPaymentMethod(): void
    {
        $methodsParams = [
            "method" => "Cartão de Crédito",
            "fee" => 7.63,
            "status" => StatusType::ACTIVATED,
        ];
        $paymentMethod = $this->paymentMethodService->storePaymentMethod($methodsParams);
    }

    protected function createCurrency(): void
    {
        $currencyParams = [
            "name" => "Dolar",
            "code" => 'USD',
            "status" => StatusType::ACTIVATED,
        ];
        $currency = $this->currencyService->storeCurrency($currencyParams);
    }

    protected function createFee(): void
    {
        $feeParams = [
            'type'        => 'A',
            'range'       => 3000,
            'less_than'   => 2,
            'more_than'   => 1,
            'description' => 'Foo description.',
            "status"      => StatusType::ACTIVATED,
        ];
        $fee = $this->feeService->storeFee($feeParams);
    }

    protected function createQuotation(): void
    {
        $quotationParams = [
            'user_id'           => 1,
            'from_currency'     => "BRL",
            'to_currency'       => "USD",
            'amount'            => 5000,
            'payment_method'    => 'PIX',
            "payment_fee"       => 72.5,
            "conversion_fee"    => 50.00,
            "new_amount"        => 4877.5,
            "quotation"         => 5.5321,
            "amount_converted"  => 881.67,
        ];
        $quotation = $this->quotationService->storeNewQuotation($quotationParams);
    }

    protected function createAuthenticatedUser(): void
    {
        User::factory()->create();
        $user = new User(['id' => 1, 'name' => 'yish']);
        $this->be($user);
    }
}
