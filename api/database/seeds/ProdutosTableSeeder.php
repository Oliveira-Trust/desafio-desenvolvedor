<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('produtos')->insert([
            [
                'descricao' => "TV Samsung 55'",
                'quantidade' => 2,
                'preco' => 2000
            ],
            [
                'descricao' => "Fone Edifier W800T",
                'quantidade' => 4,
                'preco' => 200
            ],
            [
                'descricao' => "Notebook Dell Inspiron 6",
                'quantidade' => 6,
                'preco' => 5000
            ],
            [
                'descricao' => "Xbox X Series",
                'quantidade' => 6,
                'preco' => 2500
            ],
            [
                'descricao' => "Geladeira Samsung Frost Free",
                'quantidade' => 2,
                'preco' => 3000
            ],
        ]);
    }
}
