<?php

namespace App\Http\Controllers;

use App\Contracts\FeeRepositoryInterface;
use App\Http\Requests\CreateFeeRequest;
use App\Http\Requests\UpdateFeeRequest;
use Cache;
use Illuminate\Http\Response;

class FeeController extends Controller {

    const FEE_CACHE_PREFIX = 'fee-';
    const FEE_CACHE_ALL = 'fee-all';

    public function __construct(private FeeRepositoryInterface $fee_repository) { }

    public function index() {

        $cached_response = Cache::remember(
            self::FEE_CACHE_ALL,
            now()->addMinutes(30),
            function() {
                return $this->fee_repository->getAll();
            });

        return $this->successResponse($cached_response);
    }

    public function show($fee_id) {

        $cached_response = Cache::remember(
            self::FEE_CACHE_PREFIX . $fee_id,
            now()->addMinutes(30),
            function() use ($fee_id) {
                return $this->fee_repository->findOrFail($fee_id);
            });

        return $this->successResponse($cached_response);
    }

    public function create(CreateFeeRequest $request) {
        $result = $this->fee_repository->create($request->validated());

        $cached_response = Cache::remember(
            self::FEE_CACHE_PREFIX . $result->id,
            now()->addMinutes(30),
            function() use ($result) {
                return $this->fee_repository->findOrFail($result->id);
            });

        return $this->successResponse($cached_response, 201);
    }

    public function update(UpdateFeeRequest $request, $fee_id) {
        Cache::deleteMultiple([self::FEE_CACHE_ALL,self::FEE_CACHE_PREFIX . $fee_id]);

        $result = $this->fee_repository->update($fee_id, $request->validated());

        return $this->successResponse($result);
    }

    public function destroy($fee_id) {

        $this->fee_repository->findOrFail($fee_id);

        $this->fee_repository->delete($fee_id);

        Cache::deleteMultiple([self::FEE_CACHE_ALL,self::FEE_CACHE_PREFIX . $fee_id]);

        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}
