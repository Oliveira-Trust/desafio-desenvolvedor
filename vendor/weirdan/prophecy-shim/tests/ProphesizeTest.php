<?php

namespace Weirdan\ProphecyShim\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ProphesizeTest extends TestCase
{
    use ProphecyTrait;
    public function testNoWarnings(): void
    {
        $this->prophesize(Exception::class);
    }
}
