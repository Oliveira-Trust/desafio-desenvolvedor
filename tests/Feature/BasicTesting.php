<?php

namespace Tests\Feature;

use App\Services\SWSSService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class BasicTEsting extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_spaceships_list_is_retrieved()
    {
        $response = $this->get('/spaceships');

        $response->assertStatus(200);
    }
}
