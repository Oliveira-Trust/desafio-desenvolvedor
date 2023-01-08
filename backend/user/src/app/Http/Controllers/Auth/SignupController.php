<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Services\Auth\SignupService;

class SignupController extends Controller {

    public function __invoke(SignupRequest $request) {

        $user = app(SignupService::class, [
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ])->execute();

        return $this->successResponse($user);
    }
}
