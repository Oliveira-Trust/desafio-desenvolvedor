<?php


namespace Tests\Unit;


use App\Models\Client;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class ClientModelTest extends TestCase
{
    public function testValidateClientCreate(){
        $client = new Client();
        $request = null;
        $clientReturn = $client->saveAndValidate($request);
        $this->assertFalse($clientReturn);
        $this->assertNotEmpty($clientReturn);
    }

}
