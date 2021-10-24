<?php


namespace App\Services\User;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotacao\CotacaoTaxa;
use App\Models\Cotacao\CotacaoTaxaRange;
use App\Models\UserCotacao;
use App\Models\UserCotacaoTaxa;

class UserCotacaoTaxaService
{

    public function __construct()
    {
    }

    public function get(){
        return UserCotacaoTaxa::get();
    }

    public function show(int $id){
        return UserCotacaoTaxa::find($id);
    }

    public function store(array $inputs){
        return UserCotacaoTaxa::create($inputs);
    }

    public function updateById(array $inputs, int $id){
        return UserCotacaoTaxa::find($id)->update($inputs);
    }

    public function destroyById(int $id){
        return UserCotacaoTaxa::find($id)->delete();
    }

}
