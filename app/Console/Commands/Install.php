<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Admin\TaxRepository;
use App\Repositories\Admin\TaxIntervalRepository;
use App\Repositories\Admin\ExchangePurchaseSetupRepository;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var ExchangePurchaseSetupRepository
     */
    private $exchangePurchaseSetupRepository;

    /**
     * @var TaxIntervalRepository
     */
    private $taxIntervalRepository;
    /**
     * @var TaxRepository
     */
    private $taxRepository;

    /**
     * @param ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository
     * @param TaxIntervalRepository $taxIntervalRepository
     * @param TaxRepository $taxRepository
     */
    public function __construct(ExchangePurchaseSetupRepository $exchangePurchaseSetupRepository, TaxIntervalRepository $taxIntervalRepository, TaxRepository $taxRepository)
    {
        parent::__construct();
        $this->exchangePurchaseSetupRepository = $exchangePurchaseSetupRepository;
        $this->taxIntervalRepository = $taxIntervalRepository;
        $this->taxRepository = $taxRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = app_path();

        echo shell_exec("cd {$path}");
        echo shell_exec('php artisan migrate --path=database/migrations/admin_migrations/');
        echo shell_exec('php artisan migrate --path=database/migrations/customer_migrations/');

//        echo shell_exec('php artisan migrate --path=database/migrations/relations/');
        $this->creatSetup();
        echo shell_exec('php artisan db:seed --class=AdminUsersTableSeeder');
        echo shell_exec('php artisan db:seed --class=PopulateCustomersTable');
        echo shell_exec('php artisan config:clear');
        echo shell_exec('php artisan cache:clear');
        echo shell_exec('php artisan view:clear');
    }

    private function creatSetup()
    {
        echo __METHOD__ . "\n";
        $setupId = $this->exchangePurchaseSetupRepository->create([])->id;
        $valorCompra = $this->taxRepository->create(['name' => 'valor_da_compra', 'setup_id' => $setupId, 'value' => 0]);
        $this->taxIntervalRepository->create(['tax_id' => $valorCompra->id, 'min' => 1000.0, 'max' => 100000.0]);
        $boleto = $this->taxRepository->create(['name' => 'boleto', 'setup_id' => $setupId, 'value' => 1.75]);
        $this->taxIntervalRepository->create(['tax_id' => $boleto->id]);
        $cartao = $this->taxRepository->create(['name' => 'cartao_de_credito', 'setup_id' => $setupId, 'value' => 7.63]);
        $this->taxIntervalRepository->create(['tax_id' => $cartao->id]);
        $taxaMin = $this->taxRepository->create(['name' => 'taxa_de_conversao_min', 'setup_id' => $setupId, 'value' => 2]);
        $this->taxIntervalRepository->create(['tax_id' => $taxaMin->id, 'min' => 3000]);
        $taxaMax = $this->taxRepository->create(['name' => 'taxa_de_conversao_max', 'setup_id' => $setupId, 'value' => 1]);
        $this->taxIntervalRepository->create(['tax_id' => $taxaMax->id, 'min' => 3000]);

    }
}
