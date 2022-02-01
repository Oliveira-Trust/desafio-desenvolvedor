<?php

namespace Tests\Unit\Actions;

use Domain\Fees\Actions\CalculationConversionFeesAction;
use Domain\Fees\Actions\CalculationPaymentFeesAction;
use Domain\Fees\Actions\CalculationTotalFeesAction;
use Domain\Fees\Models\Fees;
use Domain\PaymentMethod\Models\PaymentMethod;
use Domain\PaymentMethod\Repositories\PaymentMethodRepository;
use Domain\Purchase\Actions\CreatePurchaseAction;
use Domain\Purchase\Actions\CurrencyConvertAction;
use Domain\Purchase\DataTransferObjects\PurchaseData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Infra\AwesomeApi\AwesomeApiClient;
use Tests\TestCase;

class CreatePurchaseActionTest extends TestCase
{
    use RefreshDatabase;

    public function mockFees()
    {
        $paymentMethod = [
            'name' => 'boleto',
            'display_name' => 'Boleto'
        ];

        $createPaymentMethod = PaymentMethod::create($paymentMethod);

        $fees = [
            'payment_method_id' => $createPaymentMethod->id,
            'percentage' => 1.74,
        ];

        return Fees::create($fees);
    }

    public function purchaseAction()
    {
        return new CreatePurchaseAction(
            new PaymentMethodRepository(),
            new CalculationPaymentFeesAction,
            new CalculationConversionFeesAction,
            new CalculationTotalFeesAction,
            new CurrencyConvertAction(
                new AwesomeApiClient()
            )
        );
    }

    /**
     * @throws \App\Core\Exceptions\HttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function test_create_a_new_purchase_register()
    {
        $this->mockFees();

        $user = new User([
            'name' => 'John Adão',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->save();

        $this->be($user);

        $purchaseData = new PurchaseData([
            "origin" => "BRL",
            "destiny" => "USD",
            "value" => 2400,
            "payment_method" => "boleto"
        ]);

        $createdPuchase = ($this->purchaseAction())($purchaseData);

        $this->assertTrue($purchaseData->origin === $createdPuchase->origin);
        $this->assertTrue($purchaseData->destiny === $createdPuchase->destiny);
    }
}
