<?php

namespace App\Http\Controllers\Api\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeRequest;
use App\Http\Requests\UpdateFeeRequest;
use App\Http\Resources\FeeResource;
use App\Models\Fee;
use Illuminate\Http\JsonResponse;

class FeeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(FeeResource::collection(Fee::all()));
    }

    public function store(StoreFeeRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $fee = Fee::create($payload);

        return response()->json(new FeeResource($fee));
    }

    public function show(Fee $fee): JsonResponse
    {
        return response()->json(new FeeResource($fee));
    }

    public function update(UpdateFeeRequest $request, Fee $fee): JsonResponse
    {
        $fee->update($request->validated(), ['id' => $fee->id]);
        return response()->json(new FeeResource($fee));
    }

    public function destroy(Fee $fee)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        if(!$user->isAdmin()){
            abort(403, 'Forbidden');
        }

        $fee->delete();
        return response()->json(null, 204);
    }
}
