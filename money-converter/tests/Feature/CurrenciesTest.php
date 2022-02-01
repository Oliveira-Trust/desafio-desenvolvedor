<?php

namespace Tests\Feature;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrenciesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_all_availables_currencies()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/v1/currencies');

        $response->assertStatus(200);
    }
}
