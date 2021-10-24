<?php


namespace App\Services\Cotacao;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotacao\CotacaoTaxaRange;

class CotacaoTaxaRangeService
{

    public function __construct()
    {
    }

    public function get(){
        return CotacaoTaxaRange::get();
    }

    public function storeOrUpdateById(array $inputs, int $id){
        $cotacaoTaxaRangeModel = $this->show($id);

        if($cotacaoTaxaRangeModel == null){
            return $this->store($inputs, $id);
        } else {
            return $this->updateById($inputs, $id);
        }
    }

    public function updateById(array $inputs, int $id){
        return CotacaoTaxaRange::where('cotacao_taxa_id', $id)->update($inputs);
    }

    public function store(array $inputs, $id){
        $inputs['cotacao_taxa_id'] = $id;
        return CotacaoTaxaRange::create($inputs);
    }

    public function show(int $id){
        return CotacaoTaxaRange::query()
            ->where('cotacao_taxa_id', $id)
            ->first();
    }
    
    public function destroyById(int $id){
        return CotacaoTaxaRange::where('cotacao_taxa_id', $id)->delete();
    }    
}
