<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function login($user = null)
    {

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'User PHP  UNIT',
            'username' => 'phpunittest', 
            'email' => 'admin@phpunittest.com', 
            'password' => bcrypt('password')
        ]);

        $role = Role::all();

        $user->roles()->attach($role);


        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'password',
        ]);


        return $this->be($user);
    }
}
