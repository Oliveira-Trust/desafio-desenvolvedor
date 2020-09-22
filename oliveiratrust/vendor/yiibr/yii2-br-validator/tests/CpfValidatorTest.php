<?php

namespace yiibr\brvalidator\tests;

use yiibr\brvalidator\CpfValidator;


/**
 * CpfValidatorTest
 */
class CpfValidatorTest extends TestCase
{
    public function testValidateValue()
    {
        $val = new CpfValidator();
        $this->assertFalse($val->validate('7895422'));

        $this->assertFalse($val->validate('11111111111'));
        $this->assertFalse($val->validate('111.111.111-11'));
        $this->assertFalse($val->validate('234.567.058-4_'));

        $this->assertFalse($val->validate('222.451.811-08'));
        $this->assertFalse($val->validate('22245181108'));

        $this->assertTrue($val->validate('222.451.811-07'));
        $this->assertTrue($val->validate('22245181107'));
    }
}
