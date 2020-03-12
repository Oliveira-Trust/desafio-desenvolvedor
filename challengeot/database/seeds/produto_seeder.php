<?php

use Illuminate\Database\Seeder;

class produto_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_produtos')->insert([
            'nome' => Str::random(10),
            'preco' => rand(1, 100)
        ]);
    }
}
