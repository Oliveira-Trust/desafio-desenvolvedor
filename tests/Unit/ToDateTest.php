<?php

namespace Tests\Unit;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ToDateTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFunctionToDate()
    {
        $this->assertNull(toDate(''));

        $date = Carbon::now();

        $this->assertEquals($date->format('d/m/Y H:i:s'), toDate($date, true, '', 'H:i:s', false));
    }
}
