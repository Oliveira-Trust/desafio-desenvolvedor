<?php

use Illuminate\Database\Seeder;
use App\Repositories\StatusRepository;

class StatusBaseSeeder extends Seeder
{
    /**
     * Access to User Repository
     */
    protected $statusRepository;
    protected $statusBase = [
        'addresses_active' => [
            'name' => 'Ativo',
            'ref_table' => 'addresses',
            'enable' => 1,
            'status' => 1,
        ],
        'addresses_inactive' => [
            'name' => 'Inativo',
            'ref_table' => 'addresses',
            'enable' => 1,
            'status' => 0,
        ],
        'clients_active' => [
            'name' => 'Ativo',
            'ref_table' => 'clients',
            'enable' => 1,
            'status' => 1,
        ],
        'clients_inactive' => [
            'name' => 'Inativo',
            'ref_table' => 'clients',
            'enable' => 1,
            'status' => 0,
        ],
        'contacts_active' => [
            'name' => 'Ativo',
            'ref_table' => 'contacts',
            'enable' => 1,
            'status' => 1,
        ],
        'contacts_inactive' => [
            'name' => 'Inativo',
            'ref_table' => 'contacts',
            'enable' => 1,
            'status' => 0,
        ],
        'documents_active' => [
            'name' => 'Ativo',
            'ref_table' => 'documents',
            'enable' => 1,
            'status' => 1,
        ],
        'documents_inactive' => [
            'name' => 'Inativo',
            'ref_table' => 'documents',
            'enable' => 1,
            'status' => 0,
        ],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusTable = $this->statusRepository->all();
        if ($statusTable->count() == 0) {
            foreach ($this->statusBase as $attr) {
                $createStatuses = $this->statusRepository->create($attr);
            }
            echo '-> Status Padrão Adicionados com Sucesso!' . PHP_EOL;
        } else {
            echo '-> Status Padrão não foi adicionado devido tabela não estar vazia!' . PHP_EOL;
        }
    }
}
