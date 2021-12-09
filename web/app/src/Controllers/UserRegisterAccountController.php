<?php

use Selene\Request\Request;
use App\Actions\RegisterUserAction;
use Selene\Controllers\BaseController;

class UserRegisterAccountController extends BaseController
{
    public function register(Request $request): mixed
    {
        try {
            $created = (new RegisterUserAction)->run($request);

            if ($created) {
                header('Location:' . env('APP_URL'));
                die;
            }
        } catch (\Throwable $th) {
            header('Location:' . env('APP_URL') . '/client/signup');
            die('as');
        }
    }
}
