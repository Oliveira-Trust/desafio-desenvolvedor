<?php

use Selene\Controllers\BaseController;
use Selene\Render\View;

class SignController extends BaseController
{
    public function signin(): View
    {
        return $this->view()->render(
            'pages/sign-in.html',
            [
                'pageTitle' => 'Fazer login',
                'pageIdentifier' => 'login'
            ]
        );
    }

    public function signup(): View
    {
        return $this->view()->render(
            'pages/sign-up.html',
            [
                'pageTitle' => 'Criar uma conta',
                'pageIdentifier' => 'register'
            ]
        );
    }

    public function forgotPassword(): View
    {
        return $this->view()->render(
            'pages/forgot-password.html',
            [
                'pageTitle' => 'Esqueci minha senha',
                'pageIdentifier' => 'login'
            ]
        );
    }
}
