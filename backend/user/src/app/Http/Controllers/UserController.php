<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepositoryInterface;

class UserController extends Controller {

    public function __construct(private UserRepositoryInterface $user_repository) { }

    public function show($user_id) {
        return $this->successResponse($this->user_repository->findOrFail($user_id));
    }
}
