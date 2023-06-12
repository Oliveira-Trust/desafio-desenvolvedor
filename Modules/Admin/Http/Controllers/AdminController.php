<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Http\Requests\UpdateConversionFeesRequest;
use Modules\Admin\Http\Requests\UpdatePaymentMethodsFeesRequest;
use Modules\Fee\Services\Contracts\FeeServiceInterface;

class AdminController extends Controller
{
    private $feeService;

    public function __construct(FeeServiceInterface $feeService)
    {
        $this->feeService = $feeService;
    }

    public function settings()
    {
        $fees = $this->feeService->getFees();
        return view('admin::settings.index', ['fees' => $fees]);
    }

    public function updatePaymentMethodsFees(UpdatePaymentMethodsFeesRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->feeService->updateFees($request->except(['_token', '_method']));
            DB::commit();

            return redirect()->route('admin.settings')->with('status', 'payment-fees-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao atualizar taxas de pagamento: " . $e->getMessage());
            abort(500);
        }
    }

    public function updateConversionFees(UpdateConversionFeesRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->feeService->updateFees($request->except(['_token', '_method']));
            DB::commit();

            return redirect()->route('admin.settings')->with('status', 'conversion-fees-updates');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao atualizar taxas de conversão: " . $e->getMessage());
            abort(500);
        }
    }
}
