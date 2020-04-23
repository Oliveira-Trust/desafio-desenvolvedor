<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'title' => 'Lucrando Alto em casa',
            'sub_title' => 'trabalhe de casa usando apenas o celular',
            'description' => 'Descubra agora o  Método ÚNICO e SIMPLES que me permitiu Faturar R$ 66.826,96 nos últimos meses usando apenas o meu  Celular e a Internet',
            'price' => 197,00,
            'url_image' => '/public/imagem/01.png',
            
        ]);
        

    }
}
