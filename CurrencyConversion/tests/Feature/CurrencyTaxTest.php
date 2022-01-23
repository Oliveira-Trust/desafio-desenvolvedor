<?php

namespace Tests\Feature;

use App\Models\CurrencyTax;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CurrencyTaxTest extends TestCase
{
    use DatabaseMigrations;
    


    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }
   
    public function test_usuario_nao_autenticados_nao_podem_fazer_nenuma_acao_no_currency_tax()
    {

        $CurrencyTaxArray = ['less_value'  =>  500];

        //Quando um usuário não autenticado envia a solicitação no CurrencyTax
        // ele deve voltar para a página de login

        $this->get(route('CurrencyTax.index'))
        ->assertRedirect('/login');
        $this->get(route('CurrencyTax.show', 1))
        ->assertRedirect('/login');
        $this->get(route('CurrencyTax.edit', 1))
        ->assertRedirect('/login');        
        $this->patch(route('CurrencyTax.update', 1), $CurrencyTaxArray)
        ->assertRedirect('/login');


    }




    public function test_usuario_pode_acessar_o_index_do_currency_tax()
    {

        // Se loga no sistema
        $this->login();


        //Quando o usuário visita o CurrencyTax
        $response = $this->get(route('CurrencyTax.index'));

        //Ele pode ver os detalhes do CurrencyTax
        $response->assertSee('Valor menor e Igual');
    }


 









    public function test_verificar_campo_obrigatorio_less_value_do_CurrencyTax()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyTax          = ['less_value' => null, 'less_tax' => 2, 'bigger_value' => 3000,  'bigger_tax' => 1, 'tax_credit_card'  =>  2, 'tax_bank_slip'  => 1];
        $response   = $this->patch(route('CurrencyTax.update', 1),[$CurrencyTax])
        ->assertSessionHasErrors('less_value');
    }


    public function test_verificar_campo_obrigatorio_less_tax_do_CurrencyTax()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyTax          = ['less_value' => 1000, 'less_tax' => null, 'bigger_value' => 3000,  'bigger_tax' => 1, 'tax_credit_card'  =>  2, 'tax_bank_slip'  => 1];
        $response   = $this->patch(route('CurrencyTax.update', 1),[$CurrencyTax])
        ->assertSessionHasErrors('less_tax');
    }

    public function test_verificar_campo_obrigatorio_bigger_value_do_CurrencyTax()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyTax          = ['less_value' => 1000, 'less_tax' => 2, 'bigger_value' => null,  'bigger_tax' => 1, 'tax_credit_card'  =>  2, 'tax_bank_slip'  => 1];
        $response   = $this->patch(route('CurrencyTax.update', 1),[$CurrencyTax])
        ->assertSessionHasErrors('bigger_value');
    }

    public function test_verificar_campo_obrigatorio_bigger_tax_do_CurrencyTax()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyTax          = ['less_value' => 1000, 'less_tax' => 2, 'bigger_value' => 3000,  'bigger_tax' => null, 'tax_credit_card'  =>  2, 'tax_bank_slip'  => 1];
        $response   = $this->patch(route('CurrencyTax.update', 1),[$CurrencyTax])
        ->assertSessionHasErrors('bigger_tax');
    }

    public function test_verificar_campo_obrigatorio_tax_credit_card_do_CurrencyTax()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyTax          = ['less_value' => 1000, 'less_tax' => 2, 'bigger_value' => 3000,  'bigger_tax' => 1, 'tax_credit_card'  =>  null, 'tax_bank_slip'  => 1];
        $response   = $this->patch(route('CurrencyTax.update', 1),[$CurrencyTax])
        ->assertSessionHasErrors('tax_credit_card');
    }

    public function test_verificar_campo_obrigatorio_tax_bank_slip_do_CurrencyTax()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $CurrencyTax          = ['less_value' => 1000, 'less_tax' => 2, 'bigger_value' => 3000,  'bigger_tax' => 1, 'tax_credit_card'  =>  1, 'tax_bank_slip'  => null];
        $response   = $this->patch(route('CurrencyTax.update', 1),[$CurrencyTax])
        ->assertSessionHasErrors('tax_bank_slip');
    }

    public function test_usuario_pode_acessar_a_edicao_do_currency_tax()
    {
        // Se loga no sistema
        $this->login();


        //Quando o usuário visita o CurrencyTax
        $response = $this->get(route('CurrencyTax.edit', 1))->assertSuccessful();

        //Ele pode ver os detalhes do CurrencyTax
        $response->assertSee('Valor menor e Igual');

    }

    public function test_usuario_pode_alterar_o_currency_tax()
    {
        // Se loga no sistema
        $this->login();


        // Altera o Valor
        $this->patch(route('CurrencyTax.update', 1), ['less_value' => 1000, 'less_tax' => 2, 'bigger_value' => '9.548,89',  'bigger_tax' => 1, 'tax_credit_card'  =>  1, 'tax_bank_slip'  => 1]);

        // Verifica se foi  alterado
        $response = $this->get(route('CurrencyTax.show', 1))
        ->assertSee('9.548,89');

    }
}