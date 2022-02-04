<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConversaoTaxa extends Model{
    
    protected $fillable = [
        'id',
        'empresa_id',
        'valor_minimo',
        'valor_maximo',
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
        $conversaoTaxa = [];
        $conversaoTaxa = $this->select($this->fillable)
                        ->where([
                            ['id','=',  $id]
                        ])->first();
        return $conversaoTaxa;
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
    /**
     * Buscar Por Tipo
     *
     * @param [char] $tipo
     * @return void
     */
    public function buscarPorValor( $valor ){
        $conversaoTaxa = [];
        $conversaoTaxa = DB::select('SELECT * FROM conversao_taxas where '.$valor.'  BETWEEN valor_minimo and  valor_maximo');
        return $conversaoTaxa;
    }
}
