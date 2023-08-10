<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm() {
        return view('site::auth.login');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }


    public function username() {
        $login = request()->input('identity');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);

        return $field;
    }

    protected function sendLoginResponse(Request $request) {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->json()
            ? response()->json(['url' => route('conversion::conversion.index')])
            : redirect()->intended($this->redirectPath());
    }

    protected function validateLogin(Request $request) {
        $messages = [
            'identity.required' => 'Email ou usuário é obrigatório',
            'email.required'    => 'Email ou usuário é obrigatório',
            'username.required' => 'Email ou usuário é obrigatório',
            'password.required' => 'O campo Senha é obrigatório.',
        ];

        $request->validate([
            $this->username() => 'required|string',
            'password'        => 'required|min:8|string',
        ], $messages);
    }
}
