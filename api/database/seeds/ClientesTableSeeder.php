<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'email' => 'ncosta@gmail.com',
                'nome' => "Newton",
                'sobrenome' => "Costa"
            ],
            [
                'email' => 'heric@gmail.com',
                'nome' => "Heric",
                'sobrenome' => "Branco"
            ]
        ]);
    }
}
