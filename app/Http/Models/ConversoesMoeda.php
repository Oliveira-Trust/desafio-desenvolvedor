<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ConversoesMoeda extends Model{
    protected $fillable = [
        'id',
        'empresa_id',
        'user_id',
        'valor_conversao',
        'moeda_origem',
        'moeda_destino',
        'valor_moeda_destino',
        'valor_comprado_moeda_destino',
        'forma_pagamento',
        'taxa_pagamento',
        'taxa_conversao',
        'email',
        'email_enviado',
        'valor_final_conversao',
    ];


    /**
     * Lista paginacao
     *
     * @param array $condicoes
     * @return void
     */
    public function listaPaginacao($condicoes = []){
        $conversoesMoedas = [];
        $conversoesMoedas = $this
                    ->select($this->fillable)
                    ->where( $condicoes )
                    ->paginate(5);
        return $conversoesMoedas;
    }
    /**
     * Salvar
     *
     * @param [type] $dados
     * @return void
     */
    public function salvar($dados){
        $conversaoMoeda = [];
        $conversaoMoeda = $this->create($dados);
        return $conversaoMoeda;
    }
    /**
     * Buscar Por Empresa
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorEmpresa($empresa_id){
        $conversaoMoeda = [];
        $conversaoMoeda = $this->select($this->fillable)
                        ->where([
                            ['empresa_id','=',  $empresa_id]
                        ])->get();
        // dd($conversaoMoeda);
        return $conversaoMoeda;
    }
    /**
     * Buscar Por Id
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorId($id){
        $conversaoMoeda = [];
        $conversaoMoeda = $this->select($this->fillable)
                        ->where([
                            ['id','=',  $id]
                        ])->first();
        // dd($conversaoMoeda);
        return $conversaoMoeda;
    }
}
