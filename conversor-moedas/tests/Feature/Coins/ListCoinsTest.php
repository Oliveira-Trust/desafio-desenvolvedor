<?php

namespace Tests\Feature\Coins;

use Tests\TestCase;

class ListCoinsTest extends TestCase
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

    public function test_can_list_coins_with_one_relation()
    {
        $reponse = $this->get(route('coins', [ 'with' => 'prices' ]));

        $reponse->assertStatus(200);
        $reponse->assertJson([
            'data' => [
                [
                    'coin_prices' => []
                ]
            ],
            'cacheable' => true
        ]);
    }

    public function test_can_list_coins_with_more_relations()
    {
        $reponse = $this->get(route('coins', [ 'with' => 'prices,conversions' ]));

        $reponse->assertStatus(200);
        $reponse->assertJson([
            'data' => [
                [
                    'coin_prices' => [],
                    'coin_conversions' => []
                ]
            ],
            'cacheable' => true
        ]);
    }

    public function test_cannot_list_coins_with_inexistent_relation()
    {
        $reponse = $this->get(route('coins', [ 'with' => 'nonExistentRelation' ]));

        $reponse->assertStatus(404);
        $reponse->assertExactJson([
            'errors' => [
                'Non-existent relations'
            ],
            'status' => 404
        ]);
    }
}
