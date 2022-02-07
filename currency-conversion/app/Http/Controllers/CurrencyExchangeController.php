<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\CurrencyExchange;

use App\Services\CurrencyExchangeService;
use App\Http\Requests\RequestCurrencyExchange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Yajra\DataTables\DataTables;

use Auth;
use Throwable;

class CurrencyExchangeController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $users = CurrencyExchange::get();
    return response()->json($users);
  }

  public function webIndex(Request $request)
  {
    
    if ($request->ajax()) {
      $data = CurrencyExchange::latest()->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          return '<a data-toggle="tooltip" title="Editar " href="javascript:void(0)" onclick="editar(' . $row->id . ')" class="edit btn btn-outline-success btn-xs"><i class="icon-nm fas fa-edit"></i></a>
                  <a data-toggle="tooltip" title="Remover" href="javascript:void(0)" onclick="remover(' . $row->id . ')" class="delete btn btn-outline-danger btn-xs"><i class="icon-nm far fa-trash-alt"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }else{
      $configuration = Configuration::first();
      $coins = CurrencyExchangeService::getCoinNamesAvailable($configuration->coin_exchange_from); 
    }

    return view('pages.dashboard', compact('coins', 'configuration'));

  }

  public function store(RequestCurrencyExchange $request)
  {

    $data = $request->all();
    
    $dataConversion = CurrencyExchangeService::currencyConversion($data);
    $dataConversion['user_id'] = Auth::user()->id;

    if (empty($data['id'])) {
      return $this->create($dataConversion);
    } else {
      $dataConversion['id'] = $data['id'];
      return $this->update($dataConversion);
    }

  }

  public function show($currencyExchange)
  {
    $user = CurrencyExchange::where('id', $currencyExchange)->first();
    return $user;
  }

  public function create($data)
  {
    try {
      $currencyExchange = CurrencyExchange::create($data);
      return response()->json([
        'message' => 'Currency Exchange created',
        'currencyExchange' => $currencyExchange
      ], 200);
    } catch (\Throwable $th) {
      $error = 'Erro ao cadastrar cotação: ' . $th->getMessage();
      Log::error($error);
      return response()->json([
        'error' => $error
      ], 200);
    }
  }

  public function update($data)
  {
    try {
      CurrencyExchange::find($data['id'])->update($data);

      return response()->json([
        'message' => 'Dados editados com sucesso!',
        'CurrencyExchange' => CurrencyExchange::find($data['id'])
      ], 200);
    } catch (\Throwable $th) {
      $error = 'Erro ao editar cotação: ' . $th->getMessage();
      Log::error($error);
      return response()->json([
        'error' => $error
      ], 200);
    }
  }

  public function destroy($user)
  {
    try {
      CurrencyExchange::find($user)->delete();
      return response()->json([
        'message' => 'Currency Exchange Deleted'
      ]);
    } catch (\Throwable $th) {
      $error = 'Erro ao remover cotação: ' . $th->getMessage();
      Log::error($error);
      return response()->json([
        'error' => $th->getMessage()
      ], 200);
    }
  }

}
