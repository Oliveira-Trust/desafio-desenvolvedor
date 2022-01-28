<?php

namespace App\Http\Controllers;

use App\Dto\PurchaseDto;
use App\Http\Requests\CreatePurchaseRequest;
use App\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    private PurchaseService $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        return $this->purchaseService->getAll();
    }

    /**
     * @throws \App\Exceptions\HttpException
     */
    public function store(CreatePurchaseRequest $request)
    {
        $purchaseData = $request->only(['origin', 'destiny', 'value', 'payment_type']);
        return $this->purchaseService->create(new PurchaseDto($purchaseData));
    }
}
