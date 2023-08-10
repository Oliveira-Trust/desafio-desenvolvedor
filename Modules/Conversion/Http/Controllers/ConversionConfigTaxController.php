<?php

namespace Modules\Conversion\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Conversion\Http\Requests\ConversionConfigTaxRequest;
use Modules\Conversion\Models\ConversionTax;
use Modules\Conversion\Models\PaymentType;
use Modules\Conversion\Services\ConversionTaxService;

class ConversionConfigTaxController extends Controller {

    public function index() {
        $conversionTaxs = ConversionTax::withoutTrashed()->orderBy('created_at', 'desc')->paginate();

        return view('conversion::config.tax.index', compact('conversionTaxs'));
    }

    public function create() {
        return view('conversion::config.tax.create_edit');
    }

    public function edit(ConversionTax $conversionTax) {
        return view('conversion::config.tax.create_edit', compact('conversionTax'));
    }

    public function store(ConversionConfigTaxRequest $request) {
        try {
            ConversionTax::create([
                'value' => $request->get('value'),
                'min'   => set_money_format($request->get('min')),
                'max'   => set_money_format($request->get('max')),
            ]);

            return $this->successRoute('conversion::config.tax.index', msg: 'Taxas atualizadas com sucesso!');
        } catch (Exception) {
            return $this->errorUrl(route('conversion::config.tax.create'), msg: 'Erro no salvamento das taxas!');
        }
    }

    public function update(ConversionConfigTaxRequest $request, ConversionTax $conversionTax) {
        try {
            $conversionTax->fill([
                'value' => $request->get('value'),
                'min'   => set_money_format($request->get('min')),
                'max'   => set_money_format($request->get('max')),
            ]);
            $conversionTax->save();

            return $this->successRoute('conversion::config.tax.edit', $conversionTax, 'Taxas atualizadas com sucesso!');
        } catch (Exception) {
            return $this->errorUrl(route('conversion::config.tax.edit', $conversionTax), msg: 'Erro no salvamento das taxas!');
        }
    }

    public function delete(ConversionTax $conversionTax) {
        try {
            $conversionTax->delete();

            return $this->successRoute('conversion::config.tax.index', msg: 'Taxa deletada com sucesso!');
        } catch (Exception) {
            return $this->errorUrl(route('conversion::config.tax.index'), msg: 'Erro na exclusão das taxas!');
        }
    }
}
