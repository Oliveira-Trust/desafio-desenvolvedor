<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Entities\User;
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
        $this->isLogged($request, $response, $this->auth);
        $arrayResponse = ["code"=>"erro", "message"=>"Sem Usuarios Cadastrados"];
        $users = $this->repository->getAll();
        if(empty($users)){
            return $response->withJson($arrayResponse);
        }
        $arrayResponse['code'] = 'sucesso';
        $arrayResponse['message'] = 'Usuarios encontrado';
        $arrayResponse['data'] = $users;
        return $response->withJson($arrayResponse);
    }
    public function store(Request $request, Response $response )
    {
        $data = $request->getParams();
        $arrayResponse = ["code"=>"erro", "message"=>"Não foi possivel salvar o usuario."];
        if(empty($data)){
            return $response->withJson($arrayResponse);
        }
        $user = new User();
        $user->setname($data['name']);
        $user->setusername($data['username']);
        $user->setpassword($data['password']);
        $userExists = $this->repository->getByUsername($user->getUsername());
        if($userExists){
            $arrayResponse['message'] = 'Usuario já Cadastrado.';
            return $response->withJson($arrayResponse); 
        }
        $user = $this->repository->save($user);
        $token = $this->auth->create([
            "id"=>$user->getId(),
            "name"=>$user->getName(),
            "username"=>$user->getUsername()
        ]);
        $arrayResponse['code'] = 'sucesso';
        $arrayResponse['message'] = 'Usuario salvo com sucesso.';
        $arrayResponse['token'] = $token;
        return $response->withJson($arrayResponse);
    }
    public function destroy(Request $request, Response $response, $parameters )
    {
        $this->isLogged($request, $response, $this->auth);

        $id = (int) $parameters['id'];
        $user = $this->repository->getById($id);
        $arrayResponse = ["code"=>"erro","message"=>"Não foi possivel deletar este usuario."];

        if(!$user){
            return $response->withJson($arrayResponse);
        }
        $this->repository->delete($user);
        $arrayResponse['code'] = 'sucesso';
        $arrayResponse['message'] = 'Usuario deletado com sucesso.';
        return $response->withJson($arrayResponse);
    }

    public function update(Request $request, Response $response, $parameters )
    {
        $this->isLogged($request, $response, $this->auth);
        $id = (int) $parameters['id'];
        $user = $this->repository->getById($id);
        $arrayResponse = ["code"=>"erro","message"=>"Usuario não encontrado para atualizar."];
        if(!$user){
            return $response->withJson($arrayResponse);
        }
        $data = $request->getParams();
        $validate = new Validate();
        $data = $validate->unsetEmptyData($data);
        foreach($data as $key => $value){
            $user->{'set'.$key}($value);
        }
        $this->repository->save($user);
        $arrayResponse['code'] = 'sucesso';
        $arrayResponse['message'] = 'Usuario atualizado com sucesso.';
        return $response->withJson($arrayResponse);
    }
    public function login(Request $request, Response $response)
    {
        $this->isLogged($request, $response, $this->auth);
        $arrayResponse = ["code"=>"erro", "message"=>"Usuario e/ou senha invalidos."];
        $username = $request->getParam('username');
        $user = $this->repository->getByUsername($username);
        if(!$user){
            return $response->withJson($arrayResponse);
        }
        $password = $request->getParam('password');
        $isValidPassword = $user->validatePassword($password, $user->getPassword());

        if(!$isValidPassword){
            return $response->withJson($arrayResponse);
        }
        $token = $this->auth->create([
            "id"=>$user->getId(),
            "name"=>$user->getName(),
            "username"=>$user->getUsername()
        ]);

        $arrayResponse['code'] = 'sucesso';
        $arrayResponse['message'] = 'Login efetuado com sucesso.';
        $arrayResponse['token'] = $token;

        return $response->withJson($arrayResponse);
    }
}
