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
            'id' => 1,
            'name' => 'Client1',
            'email' => 'client1@teste.com',
            'document' => '292939220',
            'birth' => '1996-07-15',
            'created_at' => '2020-02-15 04:28:14',
            'updated_at' => '2020-02-15 04:31:03',
        ]);
    }
}
