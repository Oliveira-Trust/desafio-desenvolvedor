<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Services\UserService;
use Tests\Feature\Traits\CreateModels;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use CreateModels;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    public function test_find_user_by_id(): void
    {
        $this->createUser();
        $result = $this->userService->show(1);

        $this->assertEquals('Juninho Pernambucano', $result->name);
    }

    public function test_store_user(): void
    {
        $userParams = [
            "name"      => "Edmundo",
            "email"     => 1,
            "role"      => 'admin',
            "password"  => bcrypt('secret'),
        ];
        $user = $this->userService->storeNewUser($userParams);
        $result = $this->userService->show($user->id);

        $this->assertEquals('Edmundo', $result->name);
    }

    public function test_set_new_password(): void
    {
        $this->createUser();

        $userParams = ["password"  => bcrypt('newPass')];
        $result =$this->userService->setNewPassword('email@email.com');

        $expected = [
            "user_name" => "Juninho Pernambucano",
            "user_email" => "email@email.com",
            "user_password" => '1_trocar_senha'
        ];

        $this->assertEquals($expected, $result);
    }

    public function test_error_set_new_password(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('O email informado não está cadastrado no sistema.');

        $result =$this->userService->setNewPassword('noemail@email.com');
    }
}
