<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;

class UserBaseSeeder extends Seeder
{
    /**
     * Access to User Repository
     */
    protected $userRepository;
    protected $userBase = [
        'admin' => [
            'name' => 'Admin',
            'email' => 'admin@email.com.br',
            'password' => 'admin',
        ],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTable = $this->userRepository->all();
        if ($userTable->count() == 0) {
            foreach ($this->userBase as $attr) {
                $createUseres = $this->userRepository->create($attr);
            }
            echo '-> Usuário Admin Adicionados com Sucesso!' . PHP_EOL;
        } else {
            echo '-> Usuário Admin não foi adicionado devido tabela não estar vazia!' . PHP_EOL;
        }
    }
}
