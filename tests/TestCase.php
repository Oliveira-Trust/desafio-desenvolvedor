<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public ?User $user;

    public function signIn()
    {
        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        return $this;
    }
}
