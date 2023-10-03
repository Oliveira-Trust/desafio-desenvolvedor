<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'user',
            'label' => 'Usuário',
            'description' => 'Permissão a Gestão de Usuários',
        ]);

        DB::table('roles')->insert([
            'name' => 'editor',
            'label' => 'Editor',
            'description' => 'Tem acesso a Gestão de Posts',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'label' => 'Administrador',
            'description' => 'Possui permissão irrestrita a todo o sistema',
        ]);
    }
}
