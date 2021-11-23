<?php

namespace App\Http\Controllers;

use App\Business\AuthenticationBusiness;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    /**
     * @var AuthenticationBusiness
     */
    protected $authenticationBusiness;

    public function __construct(AuthenticationBusiness $authenticationBusiness)
    {
        $this->authenticationBusiness = $authenticationBusiness;
    }

	public function showLogin()
	{
        return view('auth.auth');
    }

    public function postLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

		try {
			$this->authenticationBusiness->authenticate($email, $password);
            return redirect()->intended(route('index'));
		} catch (Exception $e) {
            return view('auth.auth', [
                'messages' => 'Nome de usuário e/ou senha incorretos. ',
            ]);
        }
    }

    public function doLogout()
    {
        $this->authenticationBusiness->logout();
        return redirect()->route('login');
    }
}
