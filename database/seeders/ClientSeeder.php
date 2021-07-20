<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // https://www.geradordecpf.org/
        DB::table('clients')->insert([
            ['user_id' => 2, 'document' => '787.667.259-09', 'phone_number' => '(21) 1234-5678', 'phone_number2' => '(21) 91234-5678', 'birth' => '1985-01-01', 'address_zipcode' => '21.842-550', 'address_street' => 'Estrada do Taquaral', 'address_number' => 0, 'address_complement' => '',  'address_neighborhood' => 'Bangu',  'city_id' => 3659,  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], 
        ]);
    }
}
