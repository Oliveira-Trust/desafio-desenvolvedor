<?php

namespace Tests\Unit;

use App\Dto\PurchaseDto;
use App\Exceptions\HttpStatus;
use App\Models\PaymentType;
use App\Models\Taxe;
use App\Models\User;
use App\Services\ConversionService;
use App\Services\CurrencyService;
use App\Services\PaymentTypeService;
use App\Services\PurchaseService;
use App\Services\TaxeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PurchaseServiceTest extends TestCase
{
    use RefreshDatabase;

    private function purchaseService()
    {
        return new PurchaseService(
            new PaymentTypeService(),
            new TaxeService(),
            new ConversionService(
                new CurrencyService()
            )
        );
    }

    public function mockPurchase()
    {
        $paymentType = [
            'name' => 'boleto',
            'display_name' => 'Boleto'
        ];

        $paymentType = PaymentType::create($paymentType);

        $taxe = [
            'payment_type_id' => $paymentType->id,
            'percentage' => 1.74,
        ];

        Taxe::create($taxe);
    }

    public function test_register_new_purchase()
    {
        $this->mockPurchase();

        $user = new User([
            'name' => 'John Adão',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->save();

        $this->be($user);

        $purchaseDto = new PurchaseDto([
            "origin" => "BRL",
            "destiny" => "USD",
            "value" => 2400,
            "payment_type" => "boleto"
        ]);

        $createdPurchase = $this->purchaseService()->create($purchaseDto);

        $this->assertTrue($createdPurchase->status() === HttpStatus::CREATED);
    }

    public function test_return_all_user_purchase()
    {
        $this->mockPurchase();

        $user = new User([
            'name' => 'John Adão',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->save();

        $this->be($user);

        $purchaseDto = new PurchaseDto([
            "origin" => "BRL",
            "destiny" => "USD",
            "value" => 2400,
            "payment_type" => "boleto"
        ]);

        $this->purchaseService()->create($purchaseDto);
        $allPurchase = $this->purchaseService()->getAll();

        $this->assertTrue(sizeof($allPurchase) === 1);
    }
}
