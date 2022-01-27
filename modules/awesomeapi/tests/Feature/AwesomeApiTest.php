<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AwesomeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_return_an_json_and_status_ok_200(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('GET', '/list-currencies')
            ->assertOk();
    }
}
