<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserBaseSeeder extends Seeder
{
    /**
     * Access to User Repository
     */
    protected $userBase = [
        'admin' => [
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@email.com.br',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTable = User::all();
        if ($userTable->count() == 0) {
            foreach ($this->userBase as $attr) {
                $attr['password'] = Hash::make('admin');
                $createUseres = User::create($attr);
            }
            echo '-> Usuário Admin Adicionados com Sucesso!' . PHP_EOL;
        } else {
            echo '-> Usuário Admin não foi adicionado devido tabela não estar vazia!' . PHP_EOL;
        }
    }
}