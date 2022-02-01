<?php

namespace App\Api\Fees\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Fees\Actions\UpdateFeesAction;
use Domain\Fees\Repositories\FeesRepository;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    private UpdateFeesAction $updateFeesAction;

    private FeesRepository $feesRepository;

    public function __construct(
        UpdateFeesAction $updateFeesAction,
        FeesRepository $feesRepository
    )
    {
        $this->updateFeesAction = $updateFeesAction;
        $this->feesRepository = $feesRepository;
    }

    public function show(Request $request, int $paymentMethodId)
    {
        $findFees = $this->feesRepository->findByPaymentMethodId($paymentMethodId);
        return response()->json($findFees);
    }

    public function update(Request $request, int $feesId): \Illuminate\Http\JsonResponse
    {
        $response = ($this->updateFeesAction)($request->all(), $feesId);
        return response()->json($response, 204);
    }
}
