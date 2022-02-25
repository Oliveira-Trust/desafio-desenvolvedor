<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ConversionRate;
use App\Models\PaymentMethod;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'user']);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ])->givePermissionTo('admin');

        ConversionRate::create([
            'value' => 3000,
            'conditional' => 'bigger_then',
            'rate' => 2,
        ]);

        ConversionRate::create([
            'value' => 3000,
            'conditional' => 'less_then',
            'rate' => 1,
        ]);

        PaymentMethod::create([
            'method' => 'credit_card',
            'fee' => 7.63,
        ]);

        PaymentMethod::create([
            'method' => 'billet',
            'fee' => 1.45,
        ]);
    }
}
