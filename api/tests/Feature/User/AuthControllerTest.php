<?php

namespace Tests\Feature\User;

use App\Models\User;

class AuthControllerTest extends \TestCase
{
    /** @test */
    public function register_success_guest_user() {

        $user = [
            'name' => 'User '.rand(),
            'username' => 'user'.rand(),
            'email' => 'user'.rand().'@mail.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $this->json('POST', '/api/register', $user);

        $this->seeStatusCode(201);
        $this->seeJson([
                "entity" => "users",
                "action" => "create",
                "result" => "success"
            ]);
    }

    /** @test */
    public function register_failed_guest_empty_fields() {

        $user = [];

        $this->json('POST', '/api/register', $user);

        $this->seeStatusCode(422);
        $this->seeJson([
            "name" => ["The name field is required."],
            "email" => ["The email field is required."],
            "username" => ["The username field is required."],
            "password" => ["The password field is required."]
        ]);
    }

    /** @test */
    public function register_failed_duplicate_email_and_username() {

        $user = [
            'name' => 'User '.rand(),
            'username' => 'user'.rand(),
            'email' => 'user'.rand().'@mail.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $this->json('POST', '/api/register', $user);
        $this->json('POST', '/api/register', $user);

        $this->seeStatusCode(422);
        $this->seeJson([
                "email" => ["The email has already been taken."],
                "username" => ["The username has already been taken."]
            ]);
    }

    /** @test */
    public function login_failed_with_username_and_password() {

        $user = factory(User::class)->create();

        $this->json('POST', '/api/login', [
            'username' => $user->username,
            'password' => 'wrong_password'
        ]);

        $this->seeStatusCode(401);
        $this->seeJson([
            "message" => "Unauthorized"
        ]);

    }

    /** @test */
    public function login_success_with_username_and_password() {

        $user = factory(User::class)->create();

        $this->json('POST', '/api/login', [
            'username' => $user->username,
            'password' => 'password'
        ]);

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'token' , 'expires_in', 'token_type'
        ]);

    }

    /** @test */
    public function me_failed_unauthorized() {

        $this->json('GET', '/api/me', []);

        $this->seeStatusCode(401);
        $this->assertEquals("Unauthorized.", $this->response->getContent());

    }

    /** @test */
    public function me_success_with_user_logged() {

        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->json('GET', '/api/me', []);

        $this->seeStatusCode(200);
        $this->seeJson($user->toArray());

    }

}