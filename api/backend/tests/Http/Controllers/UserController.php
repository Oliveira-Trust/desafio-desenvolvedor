<?php


declare(strict_types=1);

namespace App\Test\Http\Controllers;

use App\Domain\Entities\User;
use App\Http\Controllers\UserController;
use App\Domain\Repositories\Memory\UserRepositoryMemory;
use App\Service\Jwt\Jwt;
use PHPUnit\Framework\TestCase;
use Slim\Http\Request;
use Slim\Http\Response;

class UserControllerTest extends TestCase
{
    public $UserRepositoryMock;
    public $authMock;
    public $ContainerMock;
    public $requestMock;
    public $responseMock;
    public $pass;

    public function setUp(): void
    {
        $this->UserRepositoryMock = $this->createMock(UserRepositoryMemory::class);
        $this->authMock = $this->createMock(Jwt::class);
        $this->ContainerMock = $this->createMock(\Slim\Container::class);
        $this->requestMock = $this->createMock(Request::class);
        $this->responseMock = $this->createMock(Response::class);
        $this->responseMock->expects($this->atLeastOnce())->method('withJson');
        $this->pass = '123456';
    }
    public function testShouldAMethodIndexToUserController()
    {
        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $userController = new UserController($this->ContainerMock);
        $userController->index($this->requestMock, $this->responseMock);
    }
    public function testShouldAMethodIndexToUserControllerWhenNotHasUsers()
    {
        $this->UserRepositoryMock->expects($this->once())->method('getAll')->willReturn([false]);
        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $userController = new UserController($this->ContainerMock);
        $userController->index($this->requestMock, $this->responseMock);
    }
    public function testShouldAMethodStoreToUserControllerWhenDataIsEmpty()
    {
        $this->requestMock->expects($this->once())->method('getParams')->willReturn([]);
        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $userController = new UserController($this->ContainerMock);
        $userController->store($this->requestMock, $this->responseMock);
    }
    public function testShouldAMethodStoreToUserControllerWhenUserAlreadyExists()
    {        
        $this->requestMock->expects($this->once())->method('getParams')->willReturn([
            "name" => "tester",
            "username" => "tester01",
            "password" => $this->pass
        ]);
        $userMock = $this->createMock(User::class);
        $userMock->method('getId')->willReturn(1);
        $userMock->method('getName')->willReturn("tester");
        $userMock->method('getUsername')->willReturn("tester01");

        $this->UserRepositoryMock->method('getByuserName')->willReturn(false);

        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);
        $userController = new UserController($this->ContainerMock);
        $userController->store($this->requestMock, $this->responseMock);
    }
    public function testShouldAMethodStoreToUserControllerWhenDataNotIsEmpty()
    {        
        $this->requestMock->expects($this->once())->method('getParams')->willReturn([
            "name" => "tester",
            "username" => "tester01",
            "password" => $this->pass
        ]);
        $userMock = $this->createMock(User::class);
        $userMock->method('getId')->willReturn(1);
        $userMock->method('getName')->willReturn("tester");
        $userMock->method('getUsername')->willReturn("tester01");

        $this->UserRepositoryMock->method('getByuserName')->willReturn($userMock);
        $this->UserRepositoryMock->method('save')->willReturn($userMock);

        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);
        $userController = new UserController($this->ContainerMock);
        $userController->store($this->requestMock, $this->responseMock);
    }
    /**
     * @dataProvider destroyDataProvider
     */
    public function testShouldAMethodDestroyToUserController($user, $whenCallDelete)
    {
        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);
        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $this->UserRepositoryMock->method('getById')->willReturn($user);
        $this->UserRepositoryMock->expects($this->{$whenCallDelete}())->method('delete');
        $parameters = ['id' => 10];
        
        $userController = new UserController($this->ContainerMock);
        $userController->destroy($this->requestMock, $this->responseMock, $parameters);
    }
    public function destroyDataProvider()
    {
        return [
            "ShouldNotDeleteWhenUserNotFoundById" => [
                "user" => false,
                "whenCallDelete" => "never"
            ],
            "ShouldNotDeleteWhenUserIsFoundById" => [
                "user" => new User(),
                "whenCallDelete" => "once"
            ],
        ];
    }
    public function testShouldAMethodUpdateUserControllerWhenUserNotFoundById()
    {
        $parameters = ['id'=>10];

        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);
        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $this->UserRepositoryMock->method('getById')->willReturn(false);

        $userController = new UserController($this->ContainerMock);
        $userController->update($this->requestMock, $this->responseMock, $parameters);
    }
    public function testShouldAMethodUpdateUserControllerWhenUserIsFoundById()
    {
        $parameters = ['id'=>10];
        $name = 'tester';
        $dataUpdate = ["name"=>$name, "username"=>"tester02"];

        $userMock = $this->createMock(User::class);
        $userMock->method('getId')->willReturn(1);
        $userMock->method('getName')->willReturn($name);
        $userMock->method('getUsername')->willReturn("tester01");

        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);
        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $this->requestMock->method('getParams')->willReturn($dataUpdate);

        $this->UserRepositoryMock->method('getById')->willReturn($userMock);
        $this->UserRepositoryMock->expects($this->once())->method('save');
        
        $userController = new UserController($this->ContainerMock);
        $userController->update($this->requestMock, $this->responseMock, $parameters);
    }
    public function testShouldAMethodLoginToUserControllerWhenUserNotFoundByUsername()
    {
        $username = 'tester';
        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $this->requestMock->expects($this->at(0))
            ->method('getParam')
            ->willReturn($username);

        $this->requestMock->expects($this->at(1))
            ->method('getParam')
            ->willReturn($this->pass);

        $this->UserRepositoryMock->method('getByUsername')->willReturn(false);

        $userController = new UserController($this->ContainerMock);
        $userController->login($this->requestMock, $this->responseMock);
    }
    public function testShouldUserControllerLoginWhenUserIsFoundByUsernameButPassIsNotValid()
    {
        $password = $this->pass;
        $this->requestMock->method('getParam')->willReturn($password);
        $userMock = $this->createMock(User::class);
        $userMock->method('getPassword')->will($this->returnCallback(
            function () use ($password) {
                return password_hash($password, PASSWORD_DEFAULT);
            }
        ));
        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);

        $this->UserRepositoryMock->method('getByUsername')->willReturn($userMock);

        $userController = new UserController($this->ContainerMock);
        $userController->login($this->requestMock, $this->responseMock);
    }
    public function testShouldUserControllerLoginWhenUserEveryIsOk()
    {
        $password = $this->pass;
        $this->requestMock->method('getParam')->willReturn($password);
        $userMock = $this->createMock(User::class);
        $userMock->method('getPassword')->will($this->returnCallback(
            function () use ($password) {
                return password_hash($password, PASSWORD_DEFAULT);
            }
        ));
        $userMock->method('validatePassword')->willReturn(true);

        $this->ContainerMock->expects($this->at(0))
            ->method('get')
            ->willReturn($this->UserRepositoryMock);

        $this->ContainerMock->expects($this->at(1))
            ->method('get')
            ->willReturn($this->authMock);
        $this->UserRepositoryMock->method('getByUsername')->willReturn($userMock);
        $userController = new UserController($this->ContainerMock);
        $userController->login($this->requestMock, $this->responseMock);
    }
}
