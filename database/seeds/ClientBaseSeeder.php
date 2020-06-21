<?php

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Seeder;
use App\Repositories\ClientRepository;
use App\Repositories\StatusRepository;

class ClientBaseSeeder extends Seeder
{
    /**
     * Access to User Repository
     */
    protected $clientRepository;
    protected $statusRepository;
    protected $clientBase = [
        'a' => [
            'name' => 'Daniel A',
            'dob' => '1982-09-02',
        ],
        'b' => [
            'name' => 'Renato B',
            'dob' => '1986-10-22',
        ],
        'c' => [
            'name' => 'Ricardo C',
            'dob' => '1989-08-12',
        ],
        'd' => [
            'name' => 'Ana D',
            'dob' => '2000-01-02',
        ],
        'e' => [
            'name' => 'Luiza E',
            'dob' => '2003-02-01',
        ],
        'f' => [
            'name' => 'Carlos F',
            'dob' => '1981-12-30',
        ],
        'g' => [
            'name' => 'Cleiton G',
            'dob' => '1979-05-13',
        ],
        'h' => [
            'name' => 'Maria H',
            'dob' => '1996-04-17',
        ],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $clientRepository, StatusRepository $statusRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->statusRepository = $statusRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientTable = $this->clientRepository->all();
        $statusUuid = $this->statusRepository->filterByRef(Client::getTableName(), ['enable' => 1, 'status' => 1])->first();
        $userId = User::first()->getUuid();
        if ($clientTable->count() == 0) {
            foreach ($this->clientBase as $attr) {
                $attr['status_id'] = $statusUuid->getUuid();
                $attr['user_id'] = $userId;
                $createClientes = $this->clientRepository->create($attr);
            }
            echo '-> Client Padrão Adicionados com Sucesso!' . PHP_EOL;
        } else {
            echo '-> Client Padrão não foi adicionado devido tabela não estar vazia!' . PHP_EOL;
        }
    }
}
