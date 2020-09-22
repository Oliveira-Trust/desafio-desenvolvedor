<?php

namespace yiibr\brvalidator\tests;

use yiibr\brvalidator\CeiValidator;


/**
 * CeiValidatorTest
 */
class CeiValidatorTest extends TestCase
{
    public function testValidateValue()
    {
        $val = new CeiValidator();
        $this->assertFalse($val->validate('2738189'));

        $this->assertFalse($val->validate('111111111111'));
        $this->assertFalse($val->validate('11.111.11111/11'));

        $this->assertTrue($val->validate('11.583.00249/85'));
        $this->assertTrue($val->validate('27.729.71181/87'));
        $this->assertTrue($val->validate('277297118187'));
    }
}
