<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);


        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin', 
            'email' => 'admin@admin.com', 
            'password' => bcrypt('admin')
        ]);




        $Roles  =  array(
            'Currency Conversion',
            'User'
        );


        $Permissions =  array(
            'view',
            'create',
            'edit',
            'delete' 
        );


        foreach ($Roles as $RoleDescription) {
            foreach ($Permissions as $Permission) {
                $Role = Role::create(['name' => $RoleDescription.' '.$Permission]);
                $Role->givePermissionTo($Permission);
                $user->assignRole($Role);
            }
        }
        $Role = Role::create(['name' => 'Currency Conversion All User']);
        $Role->givePermissionTo('view');
        $user->assignRole($Role);

        $Role = Role::create(['name' => 'Currency Conversion Edit Tax']);
        $Role->givePermissionTo('view');
        $user->assignRole($Role);


    }
}