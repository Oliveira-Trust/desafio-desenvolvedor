<?php

namespace Tests\Feature\Customer;

class AppTest extends \TestCase {

    /** @test */
    public function should_return_404_status_code_for_invalid_endpoint() {

        $this->json('GET', '/invalid_endpoint/', []);

        $this->seeStatusCode(404);
    }
}