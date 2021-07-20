<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repository\User\UserDTO as User;
use App\Repository\User\UserIRepository;

class AuthController extends Controller
{
    private $userIRepository;

    public function __construct(
        UserIRepository $userIRepository
    )
    {
        $this->userIRepository = $userIRepository;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, User::rules());

        try
        {
            $user = new User($request->all());
            $this->userIRepository->create($user);

            return response()->json( [
                        'entity' => 'users',
                        'action' => 'create',
                        'result' => 'success'
            ], 201);

        }
        catch (\Exception $e)
        {
            return response()->json( [
                       'entity' => 'users',
                       'action' => 'create',
                       'result' => 'failed'
                       ,'error' => $e->getMessage()
            ], 409);
        }
    }

     /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request
        $this->validate($request, User::rulesLogin());

        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

     /**
     * Get user details.
     *
     * @param  Request  $request
     * @return Response
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
}