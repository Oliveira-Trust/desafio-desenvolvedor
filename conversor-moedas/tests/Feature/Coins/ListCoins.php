<?php

namespace Tests\Feature\Coins;

use Tests\TestCase;

class ListCoins extends TestCase
{
    public function test_can_get_positive_response()
    {
        $response = $this->get(route('coins'));

        $response->assertStatus(200);
    }

    public function test_can_list_coins()
    {
        $response = $this->get(route('coins'));

        $response->assertJson([
            'data' => [],
            'cacheable' => true
        ]);
    }
}
