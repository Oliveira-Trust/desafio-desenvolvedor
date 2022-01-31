<?php

use Illuminate\Database\Seeder;

class PopulateCustomersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passWord = Hash::make('secret');
        $customer = \App\EloquentModels\Customer\Customer::create(['name' => 'Customer']);
        \App\EloquentModels\Customer\User::create([
            'customer_id'    => $customer->id,
            'name'           => "Customer",
            'email'          => "customer02@gmail.com",
            'password'       => $passWord,
            'remember_token' => base64_encode('secret'),
        ]);
    }
}
