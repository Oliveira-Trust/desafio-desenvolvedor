<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_role_user = 1;
        $id_role_editor = 2;

        DB::table('permissions_roles')->insert([
            'permission_id' => 1,
            'role_id' => $id_role_user,
        ]);

        DB::table('permissions_roles')->insert([
            'permission_id' => 5,
            'role_id' => $id_role_user,
        ]);

        DB::table('permissions_roles')->insert([
            'permission_id' => 9,
            'role_id' => $id_role_user,
        ]);

        DB::table('permissions_roles')->insert([
            'permission_id' => 1,
            'role_id' => $id_role_editor,
        ]);

        DB::table('permissions_roles')->insert([
            'permission_id' => 2,
            'role_id' => $id_role_editor,
        ]);

        DB::table('permissions_roles')->insert([
            'permission_id' => 3,
            'role_id' => $id_role_editor,
        ]);

        DB::table('permissions_roles')->insert([
            'permission_id' => 4,
            'role_id' => $id_role_editor,
        ]);

    }
}
