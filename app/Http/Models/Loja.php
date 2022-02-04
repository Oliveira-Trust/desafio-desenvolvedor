<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $fillable = [
        'id',
        'empresa_id',
        'nome',
        'matriz',
        'tipo_pessoa',
        'razao_social',
        'nome_fantasia',
        'cpf_cnpj',
        'inscricao_estadual',
        'isenta_ins_est',
        'inscricao_municipal',
        'email',
        'telefone',
        'celular',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'nome_cidade',
        'codigo_cidade',
        'estado',
        'timezone',
        'ativo',
        'user_id',
        'nome_usuario',
    ];
    /**
     * Salvar
     *
     * @param [type] $dados
     * @return void
     */
    public function salvar($dados){
        $loja = [];
        $loja = $this->create($dados);
        return $loja;
    }

    /**
     * Buscar Por Empresa
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorEmpresaId($empresa_id){
        $loja = [];
        $loja = $this->select('id')
                        ->where([
                            ['empresa_id','=',  $empresa_id],
                        ])->first();
        return $loja;
    }
}
