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
    private $converterSevice;

    public function __construct(FeeServiceInterface $feeService, ConverterServiceInterface $converterSevice)
    {
        $this->feeService = $feeService;
        $this->converterSevice = $converterSevice;
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

            $valueToConvert = $request->value_to_convert;
            $appliedFees = $this->feeService->applyFees($valueToConvert, $request->payment_method);
            $finalValueToConvert = $appliedFees['final_value'];

            $conversionMade = $this->converterSevice->makeConversion(
                $request->destination_currency,
                $finalValueToConvert
            );

            $data = [
                'destination_currency' => $request->destination_currency,
                'value_to_convert' => $valueToConvert,
                'payment_method' => $request->payment_method == 'credit_card' ? 'Cartão de Crédito' : ucfirst($request->payment_method),
                'destination_currency_value' => $conversionMade['destination_currency_value'],
                'purchase_value' => $conversionMade['purchase_value'],
                'payment_fee' => $appliedFees['payment_method_fee'],
                'conversion_fee' => $appliedFees['value_fee'],
                'final_conversion_value' => $finalValueToConvert
            ];

            DB::beginTransaction();
            $conversionHistory = $this->converterSevice->recordConversionHistory($data);
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
            $conversionHistory = $this->converterSevice->getConversionHistoryById(intval($conversionHistoryResultId));
            return view('converter::conversionCompleted', ['conversion' => $conversionHistory]);
        } catch (Exception $e) {
            Log::error("Erro ao encontrar histórico de conversão: " . $e->getMessage());
        }
    }
}
