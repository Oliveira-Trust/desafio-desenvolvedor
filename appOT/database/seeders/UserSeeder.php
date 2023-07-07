<?php 
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Teste OT Admin',
            'email' => 'testeotadmin@ot.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'is_admin'=>true,
        ]);
        DB::table('users')->insert([
            'name' => 'Teste OT Common User',
            'email' => 'testeot@ot.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'is_admin'=>false,
        ]);
    }
}



