<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->user = $this->createUser();

    }

    private function createUser(bool $isAdmin = false): User
    {
        return User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => '123456789',
        ]);
    }

}
