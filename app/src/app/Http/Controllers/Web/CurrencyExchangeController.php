<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyExchangeConvertResource;
use App\Models\CurrencyExchangeLogs;
use App\Modules\CurrencyExchange\Module as CurrencyExchange;
use App\Rules\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CurrencyExchangeController extends Controller
{
    public function convert (Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'originValue' => ['required', 'regex:/^\d+(([.,]\d+)?)+$/', 'gte:1000', 'lte:100000'],
                'destinationCurrency' => 'required',
                'paymentMethod' => ['required', Rule::in(CurrencyExchange::$paymentMethods)],
            ]);

            if ($validator->fails()) return response()->json(['errors' => $validator->errors()->all()], 400);

            $pricing = (new CurrencyExchange($request->originValue, strtoupper($request->destinationCurrency), $request->paymentMethod))->get();

            return response()->json(new CurrencyExchangeConvertResource($pricing));
        } catch (\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function history()
    {
        return view('history');
    }

    public function logs(Request $request): JsonResponse
    {
        try {
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $page = $start > 0 ? ($start / $length) + 1 : 1;
            $limit = $length > 0 ? $length : 10;
            $columnIndex = $request->input('order')[0]['column'];
            $columnName = $request->input('columns')[$columnIndex]['data'];
            $columnSortOrder = $request->input('order')[0]['dir'];

            $paginate = CurrencyExchangeLogs::where('user_id', Auth::user()->id)->orderBy($columnName, $columnSortOrder)->paginate($limit, ['*'], 'page', $page);
            $items = $paginate->items();

            $response = [
                'draw' => $draw,
                'recordsTotal' => CurrencyExchangeLogs::count(),
                'recordsFiltered' => $paginate->total(),
                'data' => $items
            ];

            return response()->json($response, count($items) > 0 ? 200 : 204);
        } catch (\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }
}
