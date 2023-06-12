<?php

namespace Modules\Converter\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Converter\Http\Requests\MakeConversionRequest;
use Modules\Converter\Services\Contracts\ConverterServiceInterface;
use Modules\Fee\Services\Contracts\FeeServiceInterface;

class ConverterController extends Controller
{
    private $feeService;
    private $converterService;

    public function __construct(FeeServiceInterface $feeService, ConverterServiceInterface $converterService)
    {
        $this->feeService = $feeService;
        $this->converterService = $converterService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('converter::index');
    }

    public function make(MakeConversionRequest $request)
    {
        try {

            $appliedFees = $this->feeService->applyFees($request->value_to_convert, $request->payment_method);
            $finalValueToConvert = $appliedFees['final_value'];

            $conversionMade = $this->converterService->makeConversion(
                $request->destination_currency,
                $finalValueToConvert
            );

            $data = [
                'destination_currency' => $request->destination_currency,
                'value_to_convert' => $request->value_to_convert,
                'payment_method' => $request->payment_method == 'credit_card' ? 'Cartão de Crédito' : ucfirst($request->payment_method),
                'destination_currency_value' => $conversionMade['destination_currency_value'],
                'purchase_value' => $conversionMade['purchase_value'],
                'payment_fee' => $appliedFees['payment_method_fee'],
                'conversion_fee' => $appliedFees['value_fee'],
                'final_conversion_value' => $finalValueToConvert
            ];

            DB::beginTransaction();
            $conversionHistory = $this->converterService->recordConversionHistory($data);
            DB::commit();

            return redirect()->route('converter.result', ['conversionHistoryResultId' => $conversionHistory->id]);
        } catch (Exception $e) {
            Log::error("Erro ao processar conversão:" . $e->getMessage());
            DB::rollBack();
        }
    }

    public function result(string $conversionHistoryResultId)
    {
        try {
            $conversionHistory = $this->converterService->getConversionHistoryById(intval($conversionHistoryResultId));
            return view('converter::conversionCompleted', ['conversion' => $conversionHistory]);
        } catch (Exception $e) {
            Log::error("Erro ao encontrar histórico de conversão: " . $e->getMessage());
        }
    }

    public function history()
    {
        $conversionHistories = $this->converterService->getAllConversionsHistoryFromLoggedUser();
        return view('converter::history', ['conversionHistories' => $conversionHistories]);
    }
}
