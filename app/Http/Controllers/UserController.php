<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Services\User\UserServiceContract;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceContract $userServiceContract)
    {
        $this->userService = $userServiceContract;
    }

    public function registerUser(RegisterUserRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $this->userService->store($data);

            Auth::login($user);

            return response()->json([
                'status' => 200,
                'message' => 'Registered user successfully',
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }

        //Auth::login($user);

        //  return response()->json(['message' => 'Usuário cadastrado', 'status' => 200], 200);
    }



    public function login(LoginUserRequest $request)
    {
        try {
            $credentials = $request->validated();

            if ($this->userService->login($credentials)) {
          
              return response()->redirectTo('conversao');
            } else {
                return response()->json(['message' => "Username or password is invalid!!", 'status' => 403], 403);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        $this->userService->logout();
        return response()->redirectTo('login');
    }
}
