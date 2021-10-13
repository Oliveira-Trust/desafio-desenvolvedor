<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use App\Services\FeeService;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    private $feeService;

    public function __construct(FeeService $feeService)
    {
        $this->feeService = $feeService;
    }

    public function index()
    {
        $fees = $this->feeService->getAllFees();

        return view('fee.index', compact('fees'));
    }

    public function create()
    {
        return view('fee.create');
    }

    public function store(FeeRequest $request)
    {
        $fee = $this->feeService->storeFee((array)$request->validated());

        return redirect()->route('fees.index')->with('message', 'Taxa cadastrada com sucesso!');
    }

    public function edit(Fee $fee)
    {
        return view('fee.edit', compact('fee'));
    }

    public function update(FeeRequest $request, $fee)
    {
        $result = $this->feeService->updateFee($fee, (array)$request->validated());

        return redirect()->route('fees.index')->with('message', 'Taxa alterada com sucesso!');
    }
}
