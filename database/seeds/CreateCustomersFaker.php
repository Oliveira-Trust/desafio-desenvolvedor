<?php

use Illuminate\Database\Seeder;

class CreateCustomersFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker     = Faker\Factory::create();
        $fakerBR   = Faker\Factory::create('pt_BR');
        $faker->addProvider(new JansenFelipe\FakerBR\FakerBR($faker));

        for ( $i=1; $i<=50; $i++ ){
            $data['name']     = $fakerBR->name;
            $data['email']    = $fakerBR->email;
            $data['document'] = $faker->cpf;
            $data['phone']    = '21' . str_replace( '-', '', $fakerBR->cellphone );
            $data['status']   = 1;

            $json = \App::make('App\MyClass\Json\CustomerSave');
            $json->set( json_encode( $data ) );

            ( new App\Repositories\CustomerRepository() )->createOrUpdate( $json );
        }
    }
}
