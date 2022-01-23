<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    


    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }
    
    public function test_usuario_nao_autenticados_nao_podem_fazer_nenuma_acao_no_user()
    {

        //Cria um factory array do User array para o teste
        $UserArray     = User::factory()->make()->toArray();

        //Cria um factory do User apenas para teste
        $User          = User::factory()->create();

        //Quando um usuário não autenticado envia a solicitação no User
        // ele deve voltar para a página de login

        $this->get(route('User.index'))
        ->assertRedirect('/login');
        $this->get(route('User.create'))
        ->assertRedirect('/login');
        $this->post(route('User.store'), $UserArray)
        ->assertRedirect('/login');
        $this->patch(route('User.update', $User->id), $UserArray)
        ->assertRedirect('/login');
        $this->delete(route('User.destroy', $User->id))
        ->assertRedirect('/login');


    }




    public function test_usuario_pode_acessar_o_index_do_User()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um User no banco de dados
        $User                      = User::factory()->create();

        //Quando o usuário visita o User
        $response = $this->get(route('User.index'));

        //Ele pode ver os detalhes do User
        $response->assertSee('Adicionar');
    }




    public function test_usuario_pode_acessar_a_pagina_show_do_User()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um User no banco de dados
        $User                      = User::factory()->create();

        //Quando o usuário tenta acessar o User
        $response = $this->get(route('User.show', $User->id))->assertSuccessful();


        //Ele pode ver os detalhes do User
        $response->assertSee($User->name);
    }



    public function test_usuario_pode_adicionar_um_User()
    {
        // Se loga no sistema
        $this->login();

        // Cria Array com factory do User
        $User = ['name' => 'Mrs. Catalina Emmerich DVM', 'email' => 'eturcotte@example.org', 'username' => 'oda14', 'password' => 'paseturcotterw5_s', 'roles' => [1, 2]];

        //Adiciona um User no banco de dados
        $response           = $this->post(route('User.store'),$User);

        $User = User::all()->last();

        //Quando o usuário visita o User
        $response = $this->get(route('User.show', $User->id))->assertSuccessful();


        //Ele pode ver os detalhes que foram  adicionados
        $response->assertSee('Mrs. Catalina Emmerich DVM');
    }




    public function test_verificar_campo_obrigatorio_name_do_User()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $User = ['name' => null, 'email' => 'eturcotte@example.org', 'username' => 'oda14', 'password' => 'paseturcotterw5_s', 'roles' => [1, 2]];
        $response   = $this->post(route('User.store'),[$User])
        ->assertSessionHasErrors('name');

    }

    public function test_verificar_campo_obrigatorio_email_do_User()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $User = ['name' => 'Mrs. Catalina Emmerich DVM', 'email' => null, 'username' => 'oda14', 'password' => 'paseturcotterw5_s', 'roles' => [1, 2]];
        $response   = $this->post(route('User.store'),[$User])
        ->assertSessionHasErrors('email');

    }

    public function test_verificar_campo_obrigatorio_username_do_User()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $User = ['name' => 'Mrs. Catalina Emmerich DVM', 'email' => 'eturcotte@example.org', 'username' => null, 'password' => 'paseturcotterw5_s', 'roles' => [1, 2]];
        $response   = $this->post(route('User.store'),[$User])
        ->assertSessionHasErrors('username');

    }

    public function test_verificar_campo_obrigatorio_password_do_User()
    {
        // Se loga no sistema
        $this->login();

        // Verifica o campo  obrigatorio
        $User = ['name' => 'Mrs. Catalina Emmerich DVM', 'email' => 'eturcotte@example.org', 'username' => 'oda14', 'password' => 'paseturcotterw5_s', 'roles' => [1, 2]];
        $response   = $this->post(route('User.store'),[$User])
        ->assertSessionHasErrors('password');

    }

    

    public function test_usuario_pode_acessar_a_edicao_do_User()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um User no banco de dados
        $User                      = User::factory()->create();

        //Quando o usuário visita o User
        $response = $this->get(route('User.edit', $User->id))->assertSuccessful();

        //Ele pode ver os detalhes do User
        $response->assertSee($User->name);

    }



    public function test_usuario_pode_alterar_o_User()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um User no banco de dados
        $User                      = User::factory()->create();
        $User->name                = "Marcos Antonio";

        // Altera o Valor
        $Valor =  '17.458,48';
        $this->patch(route('User.update', $User->id), $User->toArray());


        // Verifica se foi  alterado
        $response = $this->get(route('User.show', $User->id))
        ->assertSee('Marcos Antonio');

    }


    public function test_usuario_pode_deletar_o_User()
    {
        // Se loga no sistema
        $this->login();

        //Adiciona um User no banco de dados
        $User  = User::factory()->create();

        // Deleta
        $this->delete(route('User.destroy', $User->id));

        // Verifica se vai achar
        $response = $this->get(route('User.show', $User->id))
        ->assertStatus(404);
    }
 
}