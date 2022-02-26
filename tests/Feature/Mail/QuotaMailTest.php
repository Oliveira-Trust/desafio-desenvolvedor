<?php

namespace Tests\Feature\Mail;

use App\Mail\QuotaMail;
use App\Models\QuotationHistory;
use App\Models\User;
use Tests\TestCase;

class QuotaMailTest extends TestCase
{
    private $mail;

    protected function setUp(): void
    {
        parent::setUp();

        $quotationHistory = QuotationHistory::factory()->create([
            "currency_origin" => "BRL",
            "target_currency" => "USD",
            "value_origin" => "5000.00",
            "value_origin_with_discount" => "4877.50",
            "rate_payment" => "72.50",
            "rate_convert" => "50.00",
            "value_target_currency" => "944.77",
            "value_base_convert" => "5.16",
            "payment_method" => "bankSlip",
            'user_id' => User::factory()->create()->id
        ]);

        $this->mail = new QuotaMail($quotationHistory);
    }

    /**
     * @test
     */
    public function buildSuccess()
    {
        $this->assertInstanceOf(QuotaMail::class, $this->mail->build());
    }

    /**
     * @test
     */
    public function renderSuccess()
    {
        $this->assertIsString($this->mail->render());
    }
}
