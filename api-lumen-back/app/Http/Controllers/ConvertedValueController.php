<?php

namespace App\Http\Controllers;

use App\Http\Request\ConvertValueRequest;
use App\Http\Resource\ConvertValueResource;
use App\Repositories\Contracts\ConvertedValueRepository;
use App\Services\ConvertValue\CreateConvertValue\ConvertValueInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class ConvertedValueController extends Controller
{
    public function index(ConvertedValueRepository $repository)
    {
        $tenant = Auth::user();

        $response = $repository->getAllValueConvetedByTenant($tenant->id);

        return ConvertValueResource::collection($response);
    }

    public function store(ConvertValueRequest $request, ConvertValueInterface $service)
    {
        try {

            $response = $service->setParams($request->getAll()->all())
                            ->handle();

            return new ConvertValueResource($response);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
