<?php

namespace Tests\Feature\PaymentMethods;

use Tests\TestCase;

class ListPaymentMethodsTest extends TestCase
{
    public function test_can_get_positive_response()
    {
        $response = $this->get(route('payment-methods'));

        $response->assertStatus(200);
    }


    public function test_can_list_payment_methods()
    {
        $response = $this->get(route('payment-methods'));

        $response->assertJson([
            'data' => [
                [
                    'name' => 'Boleto',
                    'tax' => 1.45
                ],
                [
                    'name' => 'Cartão de crédito',
                    'tax' => 7.63
                ]
            ],
            'cacheable' => true
        ]);
    }
}
