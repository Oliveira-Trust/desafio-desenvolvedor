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


class UserController extends Controller
{
    protected $userRepository;

    public function __construct($request, $container)
    {
        parent::__construct($request, $container);
        $this->userRepository = $this->container['GetUserRepository']();
    }
    public function index()
    {
        try {
            $this->isLogged();
            $this->isLogged($this->auth);
            $arrayResponse = ["code" => "erro", "message" => "Sem Usuarios Cadastrados"];
            $getAllUsers = new GetAllUser($this->userRepository);
            $users = $getAllUsers->execute();
            $arrayResponse['status'] = 'sucesso';
            $arrayResponse['message'] = 'Usuarios encontrado';
            $arrayResponse['data'] = $users;
            $this->response($arrayResponse);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function store()
    {
        try {
            $data = $this->request->getBody();
            $createUser = new CreateUser($data, $this->userRepository);
            $user = $createUser->execute();
            $token = $this->auth->create([
                "id" => $user->getId(),
                "name" => $user->getName(),
                "username" => $user->getUsername()
            ]);
            $arrayResponse['status'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario salvo com sucesso.';
            $arrayResponse['user'] = ["id" => $user->getId(), "token" => $token];
            $this->response($arrayResponse);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function getOne($userid)
    {
        try {
            $this->isLogged();
            $user = $this->userRepository->getById((int)$userid);
            if(!$user){
                throw new \Exception("No users found.");
            }
            $this->response(["data" => $user->toArray()]);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function destroy($userid)
    {
        try {
            $this->isLogged();
            $id = (int) $userid;
            $removeUser = new RemoveUser($id, $this->userRepository);
            $removeUser->execute();
            $arrayResponse['status'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario deletado com sucesso.';
            $this->response($arrayResponse);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function update($userid)
    {
        try {
            $this->isLogged();
            $id = (int) $userid;
            $data = $this->request->getBody();
            $validate = new Validate();
            $updateUser = new UpdateUser($id, $data,  $validate, $this->userRepository);

            $user = $updateUser->execute();

            $arrayResponse['status'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario atualizado com sucesso.';
            $arrayResponse['data'] = $user->toArray();
            $this->response($arrayResponse);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
    public function login()
    {
        try {
            $data = $this->request->getBody();
            $handleLogin = new HandleLogin($data, $this->userRepository);
            $user = $handleLogin->execute();
            $token = $this->auth->create([
                "id" => $user->getId(),
                "name" => $user->getName(),
                "username" => $user->getUsername()
            ]);
            $arrayResponse['status'] = 'sucesso';
            $arrayResponse['message'] = 'Login efetuado com sucesso.';
            $arrayResponse['user'] = ["id" => $user->getId(), "name"=>$user->getName(),"token" => $token];
            $this->response($arrayResponse);
        } catch (\Exception $e) {
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            return $this->response($data);
        }
    }
}
