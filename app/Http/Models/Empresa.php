<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'id',
        'empresa_admin_id',
        'tipo_pessoa',
        'razao_social',
        'nome_fantasia',
        'cpf_cnpj',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'nome_cidade',
        'codigo_cidade',
        'estado',
        'email',
        'telefone',
        'celular',
        'ativou_em',
        'tipo',
        'ativo'
    ];
    /**
     * Lista paginacao
     *
     * @param array $condicoes
     * @return void
     */
    public function listaPaginacao($condicoes = []){
        $empresas = [];
        $empresas = $this
                    ->where( $condicoes )
                    ->select( 'empresas.id', 'empresas.razao_social' ,'empresas.nome_fantasia')
                    ->paginate(5);
        return $empresas;
    }

    /**
     * Buscar Por ID
     *
     * @param [type] $dados
     * @return void
     */
    public function buscarPorId( $id){
        $empresa = [];
        $empresa = $this->select($this->fillable)
                        ->where([
                            ['id','=',  $id]
                        ])->first();
        return $empresa;
    }
    /**
     * Salvar
     *
     * @param [type] $dados
     * @return void
     */
    public function salvar($dados){
        $empresa = [];
        $empresa = $this->create($dados);
        return $empresa;
    }
    /**
     * Atualizar
     *
     * @param [type] $dados
     * @return void
     */
    public function atualizar($dados){
        $empresa = [];
        $empresa = $this->update($dados);
        return $empresa;
    }
}
