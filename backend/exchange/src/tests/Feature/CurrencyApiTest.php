<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase;

class CurrencyApiTest extends TestCase {
    use CreatesApplication;
    use RefreshDatabase;

    protected function shouldSeed() {
        return true;
    }

    public function test_index_route_success_response() {

        $response = $this->get('api/currency');
        $response->assertSuccessful();

        $response->assertJsonStructure(
            [
                '*' => [
                    'id',
                    'name',
                    'code',
                    'available_to_buy',
                    'created_at',
                    'updated_at',
                ],
            ]
        );
    }
}
