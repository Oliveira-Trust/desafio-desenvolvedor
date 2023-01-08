<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Auth\ThrottlesLogins;
use Hash;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class LoginController extends Controller {
    use ThrottlesLogins;

    public function __invoke(Request $request) {

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->incrementLoginAttempts($request);
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $user = $this->findUserByEmail($request->input('email'));

        if (!$user || !$this->checkPasswordMatch($user, $request->input('password'))) {

//            $this->incrementLoginAttempts($request);
            throw new AuthenticationException('Wrong credentials.');
        }

        $token = $user->createToken('ApiToken');

        return $this->successResponse([
            'token_type'   => 'Bearer',
            'access_token' => $token->plainTextToken,
            'expires_at'   => $token->accessToken->expires_at,
        ]);

    }

    private function findUserByEmail(string|null $email): User|null {
        return User::where('email', $email)->first();
    }

    private function checkPasswordMatch(User $user, $password): bool {
        return Hash::check($password, $user->getAuthPassword());
    }
}
