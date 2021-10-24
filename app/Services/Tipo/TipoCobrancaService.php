<?php


namespace App\Services\Tipo;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipo\TipoCobranca;

class TipoCobrancaService
{

    public function __construct()
    {
    }

    public function get(){
        return TipoCobranca::get();
    }

    public function show(int $id){
        return TipoCobranca::find($id);
    }

    public function store(array $inputs){
        return TipoCobranca::create($inputs);
    }

    public function updateById(array $inputs, int $id){
        return TipoCobranca::find($id)->update($inputs);
    }

    public function destroyById(int $id){
        return TipoCobranca::find($id)->delete();
    }
}
