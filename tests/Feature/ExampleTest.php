<?php

namespace Tests\Feature;

use App\Http\Controllers\API\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    /**
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /*
     * @return void
     */
    public function testeApiGetCoin()
    {
        $response = $this->json('GET','https://economia.awesomeapi.com.br/json/available/uniq');
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testeApiGetCoinWithoutAuth()
    {
        $response = $this->get('api/getcoins');
        $response->assertStatus(500);
    }

    /*
     *
     * @return void
     */
    public function testeLoginWithAccountCorrect()
    {
        $response = $this->json('POST','/api/login', [
            'email' => 'thainan.cpv76@gmail.com',
            'password' => 'senha123'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "message" => "Usuário logado com sucesso!",
            "success" => true
        ]);
    }

    /*
     * @return void
     */
    public function testeLoginWithAccountNotCorrect()
    {
        $response = $this->json('POST','/api/login', [
            'email' => 'teste@teste.com',
            'password' => 'senhaincorreta'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "message" => "E-mail/Senha não existe, por favor registrar",
            "success" => false
        ]);
    }

    /*
     * @return void
     */
    public function testeApiRegisterUser()
    {
        $response = $this->json('POST','/api/register', [
            'teste' => 'Teste',
            'email' => 'teste@teste.com',
            'password' => 'senha123'
        ]);
        $response->assertStatus(200);
    }
}
