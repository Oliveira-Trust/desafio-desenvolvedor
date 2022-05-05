<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@admin.com";
        $user->password = bcrypt('123456');
        $user->save();
        
        $admin_role = Role::where('name', 'admin')->first();
        $user->assignRole($admin_role);
    }
}
