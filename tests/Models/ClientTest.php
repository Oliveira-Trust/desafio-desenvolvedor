<?php

namespace Tests\Models;

use Tests\TestCase;
use App\Models\Client;

class ClientTest extends TestCase
{
    public function testStructure()
    {
        $client = factory(Client::class)->make();
        $this->assertArrayHasKey('name', $client);
        $this->assertArrayHasKey('user_id', $client);
    }

    public function testByUserScope()
    {
        $clients = factory(Client::class, 3)->create();
        $this->assertEquals(3, Client::count());
        $this->assertEquals(1, Client::byUser($clients[0]->user_id)->count());
    }
}