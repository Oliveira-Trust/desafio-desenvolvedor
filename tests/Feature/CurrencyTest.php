<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;
use Oliveiratrust\Models\Quotation\Quotation;
use Tests\TestCase;

class CurrencyTest extends TestCase {

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_must_fail_because_user_not_logged_cant_view_prices()
    {
        $this->json('GET', '/api/admin/currencies')
             ->assertStatus(401);
    }

    public function test_must_fail_because_normal_user_cant_access_prices()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('GET', '/api/admin/currencies')
             ->assertStatus(403);
    }

    public function test_must_successful_admin_view_prices()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('GET', '/api/admin/currencies')
             ->assertStatus(200)
             ->assertJsonStructure(['data'])
             ->assertJsonCount(3, 'data');
    }

    public function test_must_fail_because_normal_user_cant_refresh_prices()
    {
        $user = \Oliveiratrust\Models\User\User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $this->json('GET', '/api/admin/currencies/refresh')
             ->assertStatus(403);
    }

    public function test_must_successful_admin_refresh_prices()
    {
        $user = \Oliveiratrust\Models\User\User::factory(['is_admin' => true])->create();
        Sanctum::actingAs($user, ['*']);

        $this->assertEquals(3, CurrencyPrice::count());

        $this->json('GET', '/api/admin/currencies/refresh')
             ->assertStatus(200);

        $this->assertEquals(6, CurrencyPrice::count());
    }

    public function test_must_successful_admin_refresh_prices_by_command()
    {
        $this->assertEquals(3, CurrencyPrice::count());

        $this->artisan('currency:api')->assertSuccessful();

        $this->assertEquals(6, CurrencyPrice::count());
    }

}
