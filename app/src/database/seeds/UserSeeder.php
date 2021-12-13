<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(array $user = [])
    {
        if (count($user) === 0) {
            factory(User::class, 1)->create();
        } else {
            ['data' => $data, 'amount' => $amount] = $user;
            factory(User::class, $amount)->create($data);
        }
    }
}
