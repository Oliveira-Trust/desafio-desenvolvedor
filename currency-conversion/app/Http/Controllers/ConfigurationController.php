<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Services\CurrencyExchangeService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConfigurationController extends Controller
{

  public function index()
  {
    $coins = CurrencyExchangeService::getAllCoinNamesAvailable();
    $configurations = Configuration::first();
    return view('pages.configurations', compact('configurations', 'coins'));
  }

  public function update(Request $request)
  {
    
    try {
      $data = $request->all();
      $data['payment_conversion_value'] = str_replace('.', '', $data['payment_conversion_value']);
      $data['payment_conversion_value'] = str_replace(',', '.', $data['payment_conversion_value']);
      $configuration = Configuration::first();
      $configuration->update($data);
      return response()->json([
        'message' => 'Configuration updated',
        'configuration' => $configuration
      ], 200);
    } catch (\Throwable $th) {
      $error = 'Erro ao editar configuração: ' . $th->getMessage();
      Log::error($error);
      return response()->json([
        'error' => $error
      ], 200);
    }

  }

}
