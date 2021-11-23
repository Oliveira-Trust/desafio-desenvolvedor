<?php

namespace App\Business;

use Illuminate\Support\Facades\Session;

class AuthenticationBusiness
{
    const SESSION_KEY_USER = 'user';

    public function __construct()
    {

    }

    /**
     * @param string $email
     * @param string $password
     */
    public function authenticate($email, $password)
    {
        if ($email !== config('auth.email_auth')) {
            throw new \Exception('Usuário incorreto.');
        }

        if ($password !== config('auth.pin_auth')) {
            throw new \Exception('Senha incorreta.');
        }

        Session::put(self::SESSION_KEY_USER, 'authenticated');
        Session::put('logged', true);

        return true;
    }

    /**
     * @return boolean
     */
    public function isAuthenticated()
    {
        return Session::has(self::SESSION_KEY_USER);
    }

    public function logout()
    {
        Session::flush();
    }
}
