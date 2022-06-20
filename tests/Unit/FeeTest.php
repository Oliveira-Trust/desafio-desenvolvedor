<?php

namespace Tests\Unit;

use Oliveiratrust\Fee\FeeRepository;
use PHPUnit\Framework\TestCase;

class FeeTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_empty_fee_should_return_zero()
    {
        $feeRepository = app()->make(FeeRepository::class);

        $this->assertEquals(0, $feeRepository->getCalculedFee());
    }
}
