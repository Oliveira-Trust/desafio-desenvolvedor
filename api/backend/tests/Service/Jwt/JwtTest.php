<?php
declare(strict_types=1);
namespace App\Test\Service\Jwt;

use App\Service\Jwt\Jwt;
use PHPUnit\Framework\TestCase;

class JwtTest extends TestCase
{
    public function testShouldCreateJwt()
    {
        $jwtClass = new Jwt('secret_key');
        $data = [
            "id"=>1,
            "name"=>"tester"
        ];
        $token = $jwtClass->create($data);
        $this->assertNotEmpty($token);
    }
    /**
     * @dataProvider dataProviderValidateToken
     */
    public function testValidateToken($token, $expectedResult, $secret)
    {
        $jwtClass = new Jwt($secret);
        $response = $jwtClass->validate($token);
        $this->assertEquals($expectedResult, $response);
    }
    
    public function dataProviderValidateToken()
    {
        $data = new \stdClass();        
        $data->id = 1;
        $data->name = "tester";
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MSwibmFtZSI6InRlc3RlciJ9.ewO_hnYMPQKOPJwvUo2sPpbGzYQ4q4qhA2-GXTCT5Zg";

        return [
            "ShouldBeValideWhenTokenReceivedIsJwt"=>[
                "token" => $token, 
                "expectedResult"=> $data,
                "secret"=> "secret_key"
            ],
            "ShouldNotBeValideWhenTokenReceivedIsEmpty"=>[
                "token"=>"",
                "expectedResult"=> false,
                "secret"=> "secret_key"
            ],
            "ShouldNotBeValideWhenSecretKeyDontMatche"=>[
                "token"=>$token,
                "expectedResult"=> false,
                "secret"=> "secret_key2"
            ]
        ];
    }

}