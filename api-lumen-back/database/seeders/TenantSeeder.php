<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'subdomain' => 'tenant1'
        ]);
        Tenant::create([
            'subdomain' => 'tenant2'
        ]);
        Tenant::create([
            'subdomain' => 'tenant3'
        ]);
    }
}
