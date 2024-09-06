<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Mockery\Exception;

class PainelController extends Controller
{
    public function index()
    {
        $config = Config::find(1);
        return view('painel.index', compact('config'));
    }

    public function upsert(Request $request)
    {
        // Removendo os símbolos de porcentagem
        $data = $request->all();
        $data['taxa_conv_acima'] = str_replace('%', '', $data['taxa_conv_acima']);
        $data['taxa_conv_abaixo'] = str_replace('%', '', $data['taxa_conv_abaixo']);
        $data['taxa_boleto'] = str_replace('%', '', $data['taxa_boleto']);
        $data['taxa_cartao'] = str_replace('%', '', $data['taxa_cartao']);

        try {
            $config = Config::find(1);

            if($config) {
                $config->update($data);

                return redirect()->back()->with('status', 'Taxas atualizadas com sucesso!');
            } else {
                $config = Config::create($data);
                return redirect()->back()->with('status', 'Taxas definidas com sucesso!');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
