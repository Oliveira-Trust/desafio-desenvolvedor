<?php

namespace Tests\Feature;

use App\Models\CurrencyConversion;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CurrencyConversionTest extends TestCase
{
    use DatabaseMigrations;
    


    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }
    
    public function test_usuario_nao_autenticados_nao_podem_fazer_nenuma_acao_no_currency_conversion()
    {

        //Cria um factory do CurrencyConversion array para o teste
        $CurrencyConversionArray     = CurrencyConversion::factory()->make()->toArray();

        //Cria um factory do CurrencyConversion apenas para teste
        $CurrencyConversion          = CurrencyConversion::factory()->create();

        //Quando um usuário não autenticado envia a solicitação no CurrencyConversion
        // ele deve voltar para a página de login

        $this->get(route('CurrencyConversion.index'))
        ->assertRedirect('/login');
        $this->get(route('CurrencyConversion.create'))
        ->assertRedirect('/login');
        $this->post(route('CurrencyConversion.store'), $CurrencyConversionArray)
        ->assertRedirect('/login');
        $this->patch(route('CurrencyConversion.update', $CurrencyConversion->id), $CurrencyConversionArray)
        ->assertRedirect('/login');
        $this->delete(route('CurrencyConversion.destroy', $CurrencyConversion->id))
        ->assertRedirect('/login');


    }




    public function test_usuario_pode_acessar_o_index_do_currency_conversion()
    {

        // Se loga no sistema
        $this->login();

        //Adiciona um CurrencyConversion no banco de dados
        $CurrencyConversion                      = CurrencyConversion::factory()->create();

        //Quando o usuário visita o CurrencyConversion
        $response = $this->get(route('CurrencyConversion.index'));

        //Ele pode ver os detalhes do CurrencyConversion
        $response->assertSee('Adicionar');
    }





    public function test_usuario_pode_acessar_a_pagina_show_do_CurrencyConversion()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um CurrencyConversion no banco de dados
        $CurrencyConversion                      = CurrencyConversion::factory()->create();

        //Quando o usuário visita o CurrencyConversion
        $response = $this->get(route('CurrencyConversion.show', $CurrencyConversion->id))->assertSuccessful();


        //Ele pode ver os detalhes do CurrencyConversion
        $response->assertSee($CurrencyConversion->user->name);
    }


    public function test_usuario_pode_adicionar_um_currency_conversion()
    {
        // Se loga no sistema
        $this->login();

        // Cria Array com factory do CurrencyConversion
        $CurrencyConversion          = ['origin_value' => '48.684,54', 'payment_method' => 'CREDIT_CARD', 'cur_id' => '1'];


        //Adiciona um CurrencyConversion no banco de dados
        $response           = $this->post(route('CurrencyConversion.store'),$CurrencyConversion)->assertSuccessful();


        $CurrencyConversion = CurrencyConversion::all()->last();

        //Quando o usuário visita o CurrencyConversion
        $response = $this->get(route('CurrencyConversion.show', $CurrencyConversion->id))->assertSuccessful();


        //Ele pode ver os detalhes que foram  adicionados
        $response->assertSee('48.684,54');
    }




    public function test_verificar_campo_obrigatorio_origin_value_do_CurrencyConversion()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyConversion          = ['origin_value' => null, 'payment_method' => 'CREDIT_CARD', 'cur_id' => '1'];
        $response   = $this->post(route('CurrencyConversion.store'),[$CurrencyConversion])
        ->assertSessionHasErrors('origin_value');
    }


    public function test_verificar_campo_obrigatorio_payment_method_do_CurrencyConversion()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyConversion          = ['origin_value' => 1000, 'payment_method' => null, 'cur_id' => '1'];
        $response   = $this->post(route('CurrencyConversion.store'),[$CurrencyConversion])
        ->assertSessionHasErrors('origin_value');
    }

    public function test_verificar_campo_obrigatorio_cur_id_do_CurrencyConversion()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyConversion          = ['origin_value' => 1000, 'payment_method' => 'CREDIT_CARD', 'cur_id' => null];
        $response   = $this->post(route('CurrencyConversion.store'),[$CurrencyConversion])
        ->assertSessionHasErrors('cur_id');
    }




    public function test_usuario_pode_acessar_a_edicao_do_currency_conversion()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um CurrencyConversion no banco de dados
        $CurrencyConversion                      = CurrencyConversion::factory()->create();

        //Quando o usuário visita o CurrencyConversion
        $response = $this->get(route('CurrencyConversion.edit', $CurrencyConversion->id))->assertSuccessful();

        //Ele pode ver os detalhes do CurrencyConversion
        $response->assertSee($CurrencyConversion->name);

    }



    public function test_usuario_pode_alterar_o_currency_conversion()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um CurrencyConversion no banco de dados
        $CurrencyConversion                      = CurrencyConversion::factory()->create();

        // Altera o Valor
        $Valor =  '17.458,48';
        $this->patch(route('CurrencyConversion.update', $CurrencyConversion->id), ['origin_value' => $Valor, 'payment_method' => 'CREDIT_CARD', 'cur_id' => '1']);

        // Verifica se foi  alterado
        $response = $this->get(route('CurrencyConversion.show', $CurrencyConversion->id))
        ->assertSee($Valor);

    }


    public function test_usuario_pode_deletar_o_currency_conversion()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um CurrencyConversion no banco de dados
        $CurrencyConversion  = CurrencyConversion::factory()->create();


        // Deleta
        $this->delete(route('CurrencyConversion.destroy', $CurrencyConversion->id));

        // Verifica se vai achar
        $response = $this->get(route('CurrencyConversion.show', $CurrencyConversion->id))
        ->assertStatus(404);
    }
    
}