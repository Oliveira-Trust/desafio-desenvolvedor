<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UseCases\User\CreateUser;
use App\Domain\UseCases\User\GetAllUser;
use App\Domain\UseCases\User\HandleLogin;
use App\Domain\UseCases\User\RemoveUser;
use App\Domain\UseCases\User\UpdateUser;
use App\Helpers\Validate;
use App\Http\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

final class UserController extends Controller
{
    protected $repository;
    protected $auth;

    public function __construct(\Slim\Container $c)
    {
        $this->repository = $c->get('UserRepository');
        $this->auth = $c->get('auth');
    }
    public function index(Request $request, Response $response )
    {
        try{
            $this->isLogged($request, $response, $this->auth);
            $arrayResponse = ["code"=>"erro", "message"=>"Sem Usuarios Cadastrados"];
            $getAllUsers = new GetAllUser($this->repository);
            $users = $getAllUsers->execute();
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuarios encontrado';
            $arrayResponse['data'] = $users;
            return $response->withJson($arrayResponse);
        }catch (\Exception $e) {
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
    public function store(Request $request, Response $response )
    {
        $data = $request->getParams();
        $createUser = new CreateUser($data, $this->repository);
        try{
            $user = $createUser->execute();
            $token = $this->auth->create([
                "id"=>$user->getId(),
                "name"=>$user->getName(),
                "username"=>$user->getUsername()
            ]);
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario salvo com sucesso.';
            $arrayResponse['token'] = $token;
            return $response->withJson($arrayResponse);
        } catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
    public function destroy(Request $request, Response $response, $parameters )
    {
        try{
            $this->isLogged($request, $response, $this->auth);
            $id = (int) $parameters['id'];
            $removeUser = new RemoveUser($id, $this->repository);
            $removeUser->execute();
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario deletado com sucesso.';
            return $response->withJson($arrayResponse);
        } catch(\Exception $e) {
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
    public function update(Request $request, Response $response, $parameters )
    {
        try{
            $this->isLogged($request, $response, $this->auth);
            $id = (int) $parameters['id'];
            $data = $request->getParams();
            $validate = new Validate();
            $updateUser = new UpdateUser($id, $data,  $validate, $this->repository);
            $user = $updateUser->execute();
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario atualizado com sucesso.';
            $arrayResponse['data'] = $user->toArray();
            return $response->withJson($arrayResponse);
        }catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
    public function login(Request $request, Response $response)
    {
        try{
            $data = $request->getParams();
            $handleLogin = new HandleLogin($data, $this->repository);
            $user = $handleLogin->execute();
            $token = $this->auth->create([
                "id"=>$user->getId(),
                "name"=>$user->getName(),
                "username"=>$user->getUsername()
            ]);
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Login efetuado com sucesso.';
            $arrayResponse['token'] = $token;
            return $response->withJson($arrayResponse);
        }catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            return $response->withJson($arrayResponse);
        }
    }
}
