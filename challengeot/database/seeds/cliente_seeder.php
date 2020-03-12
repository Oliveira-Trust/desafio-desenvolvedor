<?php

use Illuminate\Database\Seeder;

class cliente_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_clientes')->insert([
            'nome' => Str::random(10),
        ]);
    }
}
