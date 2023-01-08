<?php

namespace App\Providers;

use App\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

}
