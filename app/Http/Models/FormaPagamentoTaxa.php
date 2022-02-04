<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPagamentoTaxa extends Model{
    protected $fillable = [
        'id',
        'empresa_id',
        'tipo',
        'porcentagem',
        'ativo'
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
     * Buscar Por id
     *
     * @param [char] $id
     * @return void
     */
    public function buscarPorId( $id ){
        $formaPagamentoTaxa = [];
        $formaPagamentoTaxa = $this->select($this->fillable)
                        ->where([
                            ['id','=',  $id]
                        ])->first();
        return $formaPagamentoTaxa;
    }
    /**
     * Buscar Por Tipo
     *
     * @param [char] $tipo
     * @return void
     */
    public function buscarPorTipo( $tipo ){
        $formaPagamentoTaxa = [];
        $formaPagamentoTaxa = $this->select($this->fillable)
                        ->where([
                            ['tipo','=',  $tipo]
                        ])->first();
        return $formaPagamentoTaxa;
    }
    /**
     * Atualizar
     *
     * @param [type] $dados
     * @return void
     */
    public function atualizar($dados){
        $formaPagamentoTaxa = [];
        $formaPagamentoTaxa = $this->update($dados);
        return $formaPagamentoTaxa;
    }
}
