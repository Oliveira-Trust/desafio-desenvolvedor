<?php

namespace Modules\Conversion\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\ValidationException;
use Modules\Conversion\Http\Requests\ConversionRequest;
use Modules\Conversion\Models\Conversion;
use Modules\Conversion\Models\CurrencyType;
use Modules\Conversion\Models\PaymentType;
use Modules\Conversion\Services\ConversionService;

class ConversionController extends Controller {

    public function index() {
        $conversions = Conversion::orderBy('created_at', 'desc')->paginate();

        return view('conversion::conversion.index', compact('conversions'));
    }

    public function create(): Renderable {
        $currencyOrigin = 'BRL';
        $paymentTypes   = PaymentType::pluck('name', 'id');
        $currencyTypes  = CurrencyType::where('name', '<>', $currencyOrigin)->pluck('name', 'id');

        return view('conversion::conversion.create', compact('paymentTypes', 'currencyTypes', 'currencyOrigin'));
    }

    public function store(ConversionRequest $request, ConversionService $service) {

        try {
            $conversion = $service->create(
                currencyOrigin: $request->get('currency_origin_name'),
                currencyDestiny:  $request->get('currency_destiny_name'),
                value: set_money_format($request->get('value')),
                paymentTypeId: $request->get('payment_type_id')
            );

            return $this->successRoute('conversion::conversion.show', $conversion);
        } catch (ValidationException $e) {
            return $this->errorUrl(route('conversion::conversion.create'),$e->getMessage());
        } catch (Exception $e) {
            return $this->errorUrl(route('conversion::conversion.create'),'Erro na conversão da moeda!');
        }
    }

    public function show(Conversion $conversion) {
        return view('conversion::conversion.show', compact('conversion'));
    }
}
