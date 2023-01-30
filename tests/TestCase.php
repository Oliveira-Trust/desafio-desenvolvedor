<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();

        // Create test user
        $this->user = User::create([
                'name' => 'Test User',
                'email' => 'user@test.com',
                'password' => '123456789',
            ]);

        // Create test data
        DB::table('currencies')->insert(
            [
                ['code' => 'USD', 'name' => 'Dollar americano'],
                ['code' => 'EUR', 'name' => 'Euro'],
                ['code' => 'GBP', 'name' => 'Libra Esterlina'],
            ]
        );
        DB::table('payment_methods')->insert(
            [
                ['method' => 'Slip', 'fee' => 1.45],
                ['method' => 'Card', 'fee' => 7.63]
            ]
        );
        DB::table('ammount_fees')->insert(
            [
                ['ammount' => 3000, 'fee' => 2],
                ['ammount' => 0, 'fee' => 1],
            ]
        );

    }

}
