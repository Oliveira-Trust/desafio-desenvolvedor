<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    


    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
        // alternatively you can call
        // $this->seed();
    }

    public function test_usuario_pode_fazer_login_com_as_credenciais_corretas()
    {



        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'eduardo_akira_1988',
            'username' => 'eduardo_akira_1988', 
            'email' => 'admin@emailqualquerqualquer.com', 
            'password' => bcrypt('password')
        ]);


                $user->assignRole(1);



        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);

    }

    public function test_usuario_nao_pode_fazer_login_com_as_credenciais_erradas()
    {




        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'eduardo_akira_1988',
            'username' => 'eduardo_akira_1988', 
            'email' => 'admin@emailqualquerqualquer.com', 
            'password' => bcrypt('password')
        ]);


                $user->assignRole(1);


        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'errado',
        ]);

        $response->assertSessionHasErrors();
    
    }


}