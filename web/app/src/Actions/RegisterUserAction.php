<?php

namespace App\Actions;

use App\Mails\UserRegisteredMail;
use App\Tasks\CreateUserByCredentialsTask;
use Selene\Request\Request;

class RegisterUserAction
{
    public function run(Request $request): bool
    {
        $data = $request->sanitize([
            'fullname',
            'email',
            'password',
            'repassword',
            'terms',
        ]);

        return (new CreateUserByCredentialsTask)->run($data);
    }
}
