<?php

namespace App\Actions;

use App\Tasks\UserSignInTask;
use Selene\Request\Request;

class UserSignInAction
{
    public function run(Request $request): bool
    {
        $data = $request->sanitize([
            'email',
            'password',
        ]);

        return (new UserSignInTask)->run($data);
    }

    public function logout(): bool
    {
        return (new UserSignInTask)->logout();
    }
}
