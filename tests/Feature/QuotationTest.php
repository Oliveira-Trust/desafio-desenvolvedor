<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Oliveiratrust\Models\Quotation\Quotation;
use Tests\TestCase;

class QuotationTest extends TestCase {

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_must_fail_because_user_not_logged_to_created_a_quototation()
    {
        $this->json('POST', '/api/quotation')
             ->assertStatus(401);
    }

    public function test_must_fail_because_user_not_logged_to_view_quotation()
    {
        $this->json('GET', '/api/quotation')
             ->assertStatus(401);
    }

    public function test_must_fail_because_has_required_fields()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('POST', '/api/quotation')
             ->assertStatus(422)
             ->assertJson([
                 'message' => 'The amount field is required. (and 2 more errors)',
                 'errors'  => [
                     'amount'          => ['The amount field is required.'],
                     'currency_id'     => ['The currency id field is required.'],
                     'payment_type_id' => ['The payment type id field is required.'],
                 ]
             ]);
    }

    public function test_must_successful_create_quotation()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'amount'          => 5000,
            'currency_id'     => 2,
            'payment_type_id' => 1
        ];

        $this->json('POST', '/api/quotation', $data)
             ->assertStatus(201)
             ->assertJsonStructure(['data'])
             ->assertJsonPath('data.user_id', $user->id)
             ->assertJsonPath('data.amount', 5000)
             ->assertJsonPath('data.currency_id', 2)
             ->assertJsonPath('data.currency_code', 'USD')
             ->assertJsonPath('data.payment_type_id', 1);
    }

    public function test_must_successful_list_my_own_quotation()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        \Oliveiratrust\Models\Quotation\Quotation::factory(4)->create(['user_id' => $user->id]);

        $this->json('GET', '/api/quotation')
             ->assertStatus(200)
             ->assertJsonStructure(['data'])
             ->assertJsonPath('data.0.user_id', $user->id)
             ->assertJsonCount(4, 'data');
    }

    public function test_must_fail_because_user_cant_send_email_the_others_users_quotations()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $quotation = \Oliveiratrust\Models\Quotation\Quotation::factory()->create();

        $this->json('POST', "/api/quotation/{$quotation->id}/email")
             ->assertStatus(403);
    }

    public function test_must_successful_send_an_email()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $quotation = \Oliveiratrust\Models\Quotation\Quotation::factory(['user_id' => $user->id])->create();

        $this->json('POST', "/api/quotation/{$quotation->id}/email")
             ->assertStatus(200);
    }

    public function test_must_successful_send_an_email_by_admin()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $quotation = \Oliveiratrust\Models\Quotation\Quotation::factory()->create();

        $this->json('POST', "/api/quotation/{$quotation->id}/email")
             ->assertStatus(200);
    }

    /*
        public function test_must_fail_because_user_not_logged()
        {
            $this->json('GET', 'api/transactions/' . $transaction->id)
                 ->assertStatus(200)
                 ->assertJsonPath('success', true)
                 ->assertJsonStructure(['success', 'transaction'])
                 ->assertJsonPath('transaction.status_id', TransactionStatus::ACCEPTED)
                 ->assertJsonPath('transaction.type_id', TransactionType::PURCHASE)
                 ->assertJsonPath('transaction.customer_id', $user->id);
        }
    */
}
