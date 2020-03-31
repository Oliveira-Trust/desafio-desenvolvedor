<?php

use Illuminate\Database\Seeder;

class CreateCatalogFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $data[] = [ 'name' => 'California Salada Chicken', 'sku' => 'at-california-salada-chicken', 'price' => '24,90', 'status' => 1 ];
        $data[] = [ 'name' => 'Manhattan', 'sku' => 'manhattan', 'price' => '29,90', 'status' => 1 ];
        $data[] = [ 'name' => 'POKE Atum', 'sku' => 'poke-atum', 'price' => '32,90', 'status' => 1 ];
        $data[] = [ 'name' => 'AÇAÍ SEM GUARANÁ 500ML', 'sku' => 'acai-sem-guarana-at-500ml', 'price' => '22,00', 'status' => 1 ];
        $data[] = [ 'name' => 'AÇAÍ SEM GUARANÁ 200ML', 'sku' => 'acai-sem-guarana-at-200ml', 'price' => '14,00', 'status' => 1 ];
        $data[] = [ 'name' => 'Água com Gás', 'sku' => 'agua-gas', 'price' => '5,50', 'status' => 1 ];
        $data[] = [ 'name' => 'Batatas dijon', 'sku' => 'batatas-dijon', 'price' => '17,90', 'status' => 1 ];
        $data[] = [ 'name' => 'Baer-Mate', 'sku' => 'baer-Mate', 'price' => '9,00', 'status' => 1 ];

        foreach ( $data as $row ){
            $json = \App::make('App\MyClass\Json\CatalogSave');
            $json->set( json_encode( $row ) );
            ( new App\Repositories\ProductRepository() )->createOrUpdate( $json );
        }
    }
}
