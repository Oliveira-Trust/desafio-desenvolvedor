<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\User\Entities\User;
use Modules\Authentication\Http\Requests\RegisterRequest;
use Modules\User\Services\UserService;
use Modules\User\Transformers\UserResource;
use Illuminate\Support\Facades\Auth;
use Modules\Authentication\Http\Requests\LoginRequest;
use DB;

class SessionController extends Controller
{
    public function __construct(
        protected User $user,
        protected UserService $userService,
        private $createToken = "Mobile App"
    ) {
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = $this->userService->create($request->all());

            DB::commit();

            return response()->json([
                'access_token' => $user->createToken($this->createToken, $this->abilities($user))->plainTextToken,
                'token_type'   => 'Bearer',
                'user'         => new UserResource($user)
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Sorry! Registration is not successfull.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {

            if (!Auth::guard('api')->attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'message' => 'Email or Password does not match with our record.',
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }

            $user = $this->userService->findByColumn(['email' => $request->email]);

            return response()->json([
                'access_token' => $user->createToken($this->createToken, $this->abilities($user))->plainTextToken,
                'token_type' => 'Bearer',
                'user' => new UserResource($user)
            ], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        try {
            return response()->json(new UserResource($request->user()));
        } catch (\Throwable $th) {
            return response()->json([], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json([], JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Sorry! Logout not successfull.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param User $user
     * @return array
     */
    private function abilities(User $user): array
    {
        return $user->is_admin ? ['admin'] : ['exchanges'];
    }
}
