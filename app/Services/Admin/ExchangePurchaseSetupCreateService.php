<?php


namespace App\Services\Admin;

use App\EloquentModels\Admin\ExchangePurchaseSetup;
use App\Repositories\Admin\TaxRepository;
use App\Repositories\Admin\TaxIntervalRepository;
use App\Repositories\Admin\ExchangePurchaseSetupRepository;
use Illuminate\Support\Facades\DB;

class ExchangePurchaseSetupCreateService
{

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
        $this->exchangePurchaseSetupRepository = $exchangePurchaseSetupRepository;
        $this->taxIntervalRepository = $taxIntervalRepository;
        $this->taxRepository = $taxRepository;
    }

    public function createSetup(array $tax, array $taxInterval, ExchangePurchaseSetup $setup)
    {
        try {
            if (count($tax)) {
                DB::beginTransaction();
                $tax['setup_id'] = $setup->id;
                $tax['name'] = str_slug($tax['name'], '_');
//                dd($tax);
                $tax = $this->taxRepository->create($tax);
                if (count($taxInterval)) {
                    $taxInterval['tax_id'] = $tax->id;
                    $this->taxIntervalRepository->create($taxInterval);
                }
                DB::commit();
                if ($tax)
                    return $tax;
            }
            return null;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getModel()
    {
        return $this->exchangePurchaseSetupRepository->create([]);
    }

    public function getLastSetup()
    {
        return $this->exchangePurchaseSetupRepository->orderBy('created_at', 'desc')->first();
    }
}
