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
        try{
            $this->isLogged($this->auth);
            $arrayResponse = ["code"=>"erro", "message"=>"Sem Usuarios Cadastrados"];
            $getAllUsers = new GetAllUser($this->userRepository);
            $users = $getAllUsers->execute();
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuarios encontrado';
            $arrayResponse['data'] = $users;
            $this->response($arrayResponse);
        }catch (\Exception $e) {
            $arrayResponse['status'] = "error";
            $arrayResponse['message'] = $e->getMessage();
            $this->response($arrayResponse);
        }
    }
    public function store()
    {
        $data = $this->request->getBody();
        $createUser = new CreateUser($data, $this->userRepository);
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
            $this->response($arrayResponse);
        } catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            $this->response($arrayResponse);
        }
    }
    public function getOne($userid)
    {
        $user = $this->userRepository->getById((int)$userid);
        $this->response(["data"=>$user->toArray()]);
    }
    public function destroy($userid)
    {
        try{
            $this->isLogged();
            $id = (int) $userid;
            $removeUser = new RemoveUser($id, $this->userRepository);
            $removeUser->execute();
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario deletado com sucesso.';
            $this->response($arrayResponse);
        } catch(\Exception $e) {
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            $this->response($arrayResponse);
        }
    }
    public function update($userid)
    {
        try{
            $this->isLogged();
            $id = (int) $userid;
            $data = $this->request->getBody();
            $validate = new Validate();
            $updateUser = new UpdateUser($id, $data,  $validate, $this->userRepository);
            
            $user = $updateUser->execute();

            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Usuario atualizado com sucesso.';
            $arrayResponse['data'] = $user->toArray();
            $this->response($arrayResponse);
        }catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            $this->response($arrayResponse);
        }
    }
    public function login()
    {
        try{
            $data = $this->request->getBody();
            $handleLogin = new HandleLogin($data, $this->userRepository);
            $user = $handleLogin->execute();
            $token = $this->auth->create([
                "id"=>$user->getId(),
                "name"=>$user->getName(),
                "username"=>$user->getUsername()
            ]);
            $arrayResponse['code'] = 'sucesso';
            $arrayResponse['message'] = 'Login efetuado com sucesso.';
            $arrayResponse['token'] = $token;
            $this->response($arrayResponse);
        }catch(\Exception $e){
            $arrayResponse['code'] = 'error';
            $arrayResponse['message'] = $e->getMessage();
            $this->response($arrayResponse);
        }
    }
}
