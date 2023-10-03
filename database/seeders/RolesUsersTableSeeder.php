<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_user = User::where('name', 'user')->first()->id;
        $id_editor = User::where('name', 'carlos')->first()->id;
        $id_admin = User::where('name', 'admin')->first()->id;

        DB::table('roles_users')->insert([
            'user_id' => $id_user,
            'role_id' => 1,
        ]);

        DB::table('roles_users')->insert([
            'user_id' => $id_editor,
            'role_id' => 2,
        ]);

        DB::table('roles_users')->insert([
            'user_id' => $id_admin,
            'role_id' => 3,
        ]);
    }
}
