<?php


namespace App\Services\Cotacao;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotacao\CotacaoTaxa;

class CotacaoTaxaService
{

    public function __construct()
    {
    }

    public function get(){
        return CotacaoTaxa::with('cotacaoTaxaRange', 'tipoCobranca')->get();
    }

    public function updateById(array $inputs, int $id){
        return CotacaoTaxa::find($id)->update($inputs);
    }

    public function store(array $inputs){
        return CotacaoTaxa::create($inputs);
    }

    public function show(int $id){
        return CotacaoTaxa::find($id);
    }
    
    public function destroyById(int $id){
        return CotacaoTaxa::find($id)->delete();
    }    
}
