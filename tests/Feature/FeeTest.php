<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;
use Oliveiratrust\Models\Fee\Fee;
use Oliveiratrust\Models\Quotation\Quotation;
use Tests\TestCase;

class FeeTest extends TestCase {

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_must_fail_because_user_not_logged_cant_view_fees()
    {
        $this->json('GET', '/api/admin/fees')
             ->assertStatus(401);
    }

    public function test_must_fail_because_normal_user_cant_access_fees()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('GET', '/api/admin/fees')
             ->assertStatus(403);
    }

    public function test_must_successful_admin_view_fees()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('GET', '/api/admin/fees')
             ->assertStatus(200)
             ->assertJsonStructure(['data'])
             ->assertJsonCount(4, 'data');
    }

    public function test_must_fail_because_form_has_required_fields()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('POST', '/api/admin/fees')
             ->assertStatus(422)
             ->assertJson([
                 'message' => 'The fee type id field is required. (and 5 more errors)',
                 'errors'  => [
                     'fee_type_id'     => ['The fee type id field is required.'],
                     'payment_type_id' => ['The payment type id field is required.'],
                     'min_amount'      => ['The min amount field is required.'],
                     'max_amount'      => ['The max amount field is required.'],
                     'percent'         => ['The percent field is required.'],
                     'fixed_value'     => ['The fixed value field is required.']
                 ]
             ]);
    }

    public function test_must_fail_because_normal_user_cant_add_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 1000,
            'percent'         => 5,
            'fixed_value'     => 0,
        ];

        $this->json('POST', '/api/admin/fees', $data)
             ->assertStatus(403);
    }

    public function test_must_fail_because_normal_user_cant_update_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $fee = Fee::create([
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 1000,
            'percent'         => 5,
            'fixed_value'     => 0,
        ]);

        $data = [
            'fee_type_id'     => 2,
            'payment_type_id' => 1,
            'min_amount'      => 100,
            'max_amount'      => 2000,
            'percent'         => 10,
            'fixed_value'     => 2,
        ];

        $this->json('PUT', '/api/admin/fees/' . $fee->id, $data)
             ->assertStatus(403);
    }

    public function test_must_fail_because_normal_user_cant_delete_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $fee = Fee::create([
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 1000,
            'percent'         => 5,
            'fixed_value'     => 0,
        ]);

        $this->json('DELETE', '/api/admin/fees/' . $fee->id)
             ->assertStatus(403);
    }

    public function test_must_fail_because_validate_amount_on_create_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 1000,
            'max_amount'      => 500,
            'percent'         => 5,
            'fixed_value'     => 0,
        ];

        $this->json('POST', '/api/admin/fees', $data)
             ->assertStatus(422);
    }

    public function test_must_fail_because_validate_percent_or_fixed_value_on_create_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 500,
            'percent'         => 0,
            'fixed_value'     => 0,
        ];

        $this->json('POST', '/api/admin/fees', $data)
             ->assertStatus(422);
    }

    public function test_must_successful_admin_create_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 1000,
            'percent'         => 5,
            'fixed_value'     => 0,
        ];

        $this->json('POST', '/api/admin/fees', $data)
             ->assertStatus(200);
    }

    public function test_must_successful_admin_update_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $fee = Fee::create([
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 1000,
            'percent'         => 5,
            'fixed_value'     => 0,
        ]);

        $data = [
            'fee_type_id'     => 2,
            'payment_type_id' => 1,
            'min_amount'      => 100,
            'max_amount'      => 2000,
            'percent'         => 10,
            'fixed_value'     => 2,
        ];

        $this->json('PUT', '/api/admin/fees/' . $fee->id, $data)
             ->assertStatus(200);

        $updatedFee = Fee::find($fee->id);

        $this->assertEquals(2, $updatedFee->fee_type_id);
        $this->assertNull($updatedFee->payment_type_id);
        $this->assertEquals(100, $updatedFee->min_amount);
        $this->assertEquals(2000, $updatedFee->max_amount);
        $this->assertEquals(10, $updatedFee->percent);
        $this->assertEquals(2, $updatedFee->fixed_value);
    }

    public function test_must_successful_admin_delete_fee()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $fee = Fee::create([
            'fee_type_id'     => 1,
            'payment_type_id' => 1,
            'min_amount'      => 0,
            'max_amount'      => 1000,
            'percent'         => 5,
            'fixed_value'     => 0,
        ]);

        $this->json('DELETE', '/api/admin/fees/' . $fee->id)
             ->assertStatus(200);

        $updatedFee = Fee::find($fee->id);

        $this->assertNull($updatedFee);
    }
}
