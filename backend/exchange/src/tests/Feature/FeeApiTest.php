<?php

namespace Tests\Feature;

use App\Models\Fee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase;

class FeeApiTest extends TestCase {
    use CreatesApplication;
    use RefreshDatabase;

    protected function shouldSeed() {
        return true;
    }

    public function test_index_route_success_response() {
        $response = $this->get('api/fee');
        $response->assertSuccessful();
        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'starting_value',
                    'fee_rate',
                    'created_at',
                    'updated_at',
                ],
            ]
        );

    }

    public function test_show_route_success_response() {
        $fee = Fee::factory()->create();

        $response = $this->get("api/fee/{$fee->id}");

        $response->assertSuccessful();

        $response->assertJson(['id' => $fee->id]);

        $response->assertJsonStructure([
            'id',
            'starting_value',
            'fee_rate',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_create_fee_route_success_response() {

        $response = $this->post("api/fee", [
            'starting_value' => 123,
            'fee_rate'       => 1.23,
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('fees', [
            'starting_value' => 123,
            'fee_rate'       => 1.23,
        ]);

        $response->assertJsonStructure([
            'id',
            'starting_value',
            'fee_rate',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_update_fee_route_success_response() {

        $fee = Fee::factory()->create([
            'starting_value' => 1,
            'fee_rate'       => 1,
        ]);

        $response = $this->put("api/fee/{$fee->id}", [
            'starting_value' => 123,
            'fee_rate'       => 1.23,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('fees', [
            'id'             => $fee->id,
            'starting_value' => 123,
            'fee_rate'       => 1.23,
        ]);

        $response->assertJsonStructure([
            'id',
            'starting_value',
            'fee_rate',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_delete_fee_route_success_response() {

        $fee = Fee::factory()->create();

        $response = $this->delete("api/fee/{$fee->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('fees', ['id'             => $fee->id,]);
    }

}
