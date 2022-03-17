<?php

namespace App\Http\Controllers;

use App\Models\Forma;
use App\Models\Taxa;
use Illuminate\Http\Request;

class TaxasController extends Controller
{
    public function index() {
        $data = [];

        $formas = Forma::all();

        $taxas = Taxa::all();

        foreach ($formas as $forma) {
            if($forma->id === 1) $data['taxaBoleto'] = number_format($forma->percentual * 100, 2, ',', '.');

            if($forma->id === 2) $data['taxaCredito'] = number_format($forma->percentual * 100, 2, ',', '.');
        }

        foreach ($taxas as $taxa) {
            $data["taxaCond$taxa->id"] = number_format($taxa->percentual * 100, 2, ',', '.');
        }
        
        return view('taxas.index', $data);
    }

    public function store(Request $request) {

        $request->validate([
            'taxa-boleto' => 'required',
            'taxa-credito' => 'required',
            'taxa-cond1' => 'required',
            'taxa-cond2' => 'required',
        ]);

        $formasData = [];

        $taxasData = [];
        
        $formasData[] = (object)["id" => 1, "percentual" => floatval(str_replace(',', '.', $request->input('taxa-boleto'))) / 100];
        
        $formasData[] = (object)["id" => 2, "percentual" => floatval(str_replace(',', '.', $request->input('taxa-credito'))) / 100];

        $taxasData[] = (object)["id" => 1, "percentual" => floatval(str_replace(',', '.', $request->input('taxa-cond1'))) / 100];
        
        $taxasData[] = (object)["id" => 2, "percentual" => floatval(str_replace(',', '.', $request->input('taxa-cond2'))) / 100];

        foreach ($formasData as $f) {
            $forma = Forma::find($f->id);

            $forma->percentual = $f->percentual;

            $forma->save();
        }

        foreach ($taxasData as $t) {
            $taxa = Taxa::find($t->id);

            $taxa->percentual = $t->percentual;

            $taxa->save();
        }
        
        return redirect("/taxas");
    }
}
