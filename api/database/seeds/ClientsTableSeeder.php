<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clients')->delete();
        
        \DB::table('clients')->insert([
            1 => [
                'id' => 1,
                'name' => 'Cliente 1',
                'email' => 'cliente1@teste.com',
                'document' => '292939220',
                'birth' => '1996-07-15',
                'created_at' => '2020-02-15 04:28:14',
                'updated_at' => '2020-02-15 04:31:03',
            ],
            2 => [
                'id' => 2,
                'name' => 'Cliente 2',
                'email' => 'cliente2@teste.com',
                'document' => '292948521',
                'birth' => '1999-01-18',
                'created_at' => '2020-02-15 04:28:14',
                'updated_at' => '2020-02-15 04:31:03',
            ]
        ]);
    }
}
