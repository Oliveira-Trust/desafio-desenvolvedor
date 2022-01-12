<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Fee\Services\FeeService;
use App\Domain\Fee\Requests\FeeUpdateRequest;


class FeeController extends Controller
{
    public function __construct(FeeService $feeService)
    {
        $this->feeService = $feeService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $fees = $this->feeService->getAllFees();

        return view('fee.index',[
            'fees' => $fees
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fee = $this->feeService->getFee($id);

        if(!$fee) {
            return redirect()->route('fee.index')->withErrors('Taxa não encontrada');
        }

        return view('fee.edit',[
           'fee' => $fee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(FeeUpdateRequest $request, $id)
    {
        $fee = $this->feeService->getFee($id);

        if(!$fee) {
            return redirect()->route('fee.index')->withErrors('Taxa não encontrada');
        }

        $updated = $this->feeService->updateFee($request, $fee);

        if(!$updated) {
            return redirect()->route('fee.edit', $fee->id)->withErrors('Houve um erro ao tentar atualizar essa taxa');
        }

        return redirect()->route('fee.index')->with('success', 'Taxa atualizada com sucesso');
    }

}
