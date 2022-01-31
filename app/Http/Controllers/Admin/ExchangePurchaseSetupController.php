<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveSetupRequest;
use App\Services\Admin\ExchangePurchaseSetupCreateService;
use Illuminate\Http\Request;

class ExchangePurchaseSetupController extends Controller
{
    /**
     * @var ExchangePurchaseSetupCreateService
     */
    private $service;

    /**
     * @param ExchangePurchaseSetupCreateService $service
     */
    public function __construct(ExchangePurchaseSetupCreateService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSetupRequest $request)
    {

        $taxes = $request->get('taxes');
        $setup = $this->service->getModel();
        $setup->save();
        foreach ($taxes as $tax){
            $this->service->createSetup($tax['tax'], $tax['interval'] ?? [], $setup);
        }
        return redirect()->route('admin.home' );
    }
}
