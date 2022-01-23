<?php

declare(strict_types=1);

namespace AwesomeApi\Tests\Feature;

use Tests\TestCase;

class AwesomeApiTest extends TestCase
{
    public function test_should_return_an_json(): void
    {
        $response = $this->json('GET', '/list-currencies');
    }
}
