<?php

namespace Oliveiratrust\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Oliveiratrust\Base\Traits\ResponseTrait;

class LoginController extends Controller {

    use ResponseTrait;

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ( ! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $token = auth()->user()->createToken('authtoken');

        return $this->successResponse(['user' => auth()->user(), 'token' => $token->plainTextToken]);
    }

    public function logout(Request $request)
    {
        if (($token = auth()->user()?->currentAccessToken()) && isset($token->id)) {
            $token->delete();
        }

        auth()->guard('web')->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return $this->successResponse();
    }
}
