<?php

namespace App\Api\Purchase\Controllers;

use App\Api\Purchase\Requests\PurchaseRequest;
use App\Core\Exceptions\HttpStatus;
use App\Core\Http\Controllers\Controller;
use Domain\Purchase\Actions\CreatePurchaseAction;
use Domain\Purchase\DataTransferObjects\PurchaseData;
use Domain\Purchase\Models\Purchase;

class PurchaseController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user()->purchases);
    }

    public function store(
        PurchaseRequest $request,
        CreatePurchaseAction $createPurchaseAction
    ): \Illuminate\Http\JsonResponse
    {
        $purchaseData = PurchaseData::fromRequest($request);
        $response = $createPurchaseAction($purchaseData);

        return response()->json($response, HttpStatus::CREATED);
    }
}
