<?php

declare(strict_types=1);

namespace App\Test\Helpers;

use App\Helpers\Validate;
use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{
    /**
     * @dataProvider dataProviderArrayUnsetEmptyField
     */
    public function testUnsetEmptyField($data, $expected)
    {
        $validate = new Validate();
        $cleanData = $validate->unsetEmptyData($data);
        $this->assertEquals($expected, $cleanData);
    }
    public function dataProviderArrayUnsetEmptyField()
    {
        return [
            "MustReturnAnArrayWithoutTheEmptyKey" => [
                "data" => ["name"=>"teste","username"=>"tester01", "pass"=>""],
                "expectedResult" => ["name"=>"teste","username"=>"tester01"]
            ],
            "TheSameArrayMustBeReturnedAsAllFieldsAreFilled" => [
                "data" => ["name"=>"teste","username"=>"tester01", "pass"=>"abc123"],
                "expectedResult"=>["name"=>"teste","username"=>"tester01", "pass"=>"abc123"]
            ],
        ];
    }
    /**
     * @dataProvider dataProviderArrayValidate
     */
    public function testValidateArray($data, $expected)
    {
        $validate = new Validate();
        $isValid = $validate->hasEmptyValue($data);
        $this->assertEquals($expected, $isValid);
    }
    public function dataProviderArrayValidate()
    {
        return [
            "mustReturnTrueWhenAnyValueInTheArrayIsEmpty" => [
                "data" => ["name"=>"","username"=>"tester01"],
                "expectedResult"=>true
            ],
            "mustReturnFalseWhenAllValuesAreFilled" => [
                "data" => ["name"=>"teste","username"=>"tester01"],
                "expectedResult"=>false
            ],
        ];
    }
}
