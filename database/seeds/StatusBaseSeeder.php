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
        'products_active' => [
            'name' => 'Ativo',
            'ref_table' => 'products',
            'enable' => 1,
            'status' => 1,
        ],
        'products_inactive' => [
            'name' => 'Inativo',
            'ref_table' => 'products',
            'enable' => 1,
            'status' => 0,
        ],
        'purchase_orders_open' => [
            'name' => 'Aberto',
            'ref_table' => 'purchase_orders',
            'enable' => 1,
            'status' => 2,
        ],
        'purchase_orders_paid' => [
            'name' => 'Pago',
            'ref_table' => 'purchase_orders',
            'enable' => 1,
            'status' => 3,
        ],
        'purchase_orders_canceled' => [
            'name' => 'Cancelado',
            'ref_table' => 'purchase_orders',
            'enable' => 1,
            'status' => 4,
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