<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pagamento;
use App\Models\Taxa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'name' =>  'Admin', 'email' => 'admin@oliveiratrust.com', 'password' => 'admin@oliveiratrust.com'],
        ];

        $pagamentos = [
            ['id' => 1, 'nome' =>  'Boleto',            'slug' => 'boleto',             'taxa' => 1.45],
            ['id' => 2, 'nome' =>  'Cartão de Crédito', 'slug' => 'cartao-de-credito',  'taxa' => 7.63],
        ];

        $taxas = [
            ['id' => 1, 'valor' =>  1000, 'taxa' => 2],
            ['id' => 2, 'valor' =>  3000, 'taxa' => 1],
        ];

        foreach ($users as $user) {
            $user = User::updateOrCreate([
                'id'    =>  $user['id']
            ], $user);

            foreach ($pagamentos as $pagamento) {
                $pagamento['user_id'] = $user->id;

                Pagamento::updateOrCreate([
                    'id'    =>  $pagamento['id']
                ], $pagamento);
            }

            foreach ($taxas as $taxa) {
                $taxa['user_id'] = $user->id;

                Taxa::updateOrCreate([
                    'id'    =>  $taxa['id']
                ], $taxa);
            }
        }
    }
}
