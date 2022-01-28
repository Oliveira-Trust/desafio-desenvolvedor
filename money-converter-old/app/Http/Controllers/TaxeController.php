<?php

namespace App\Http\Controllers;

use App\Models\Taxe;
use App\Services\TaxeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaxeController extends Controller
{

    private TaxeService $taxeService;

    public function __construct(TaxeService $taxeService)
    {
        $this->taxeService = $taxeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->taxeService->getAll();
    }


    public function update(Request $request, int $taxeId)
    {
        return $this->taxeService->update($request->all(), $taxeId);
    }
}
