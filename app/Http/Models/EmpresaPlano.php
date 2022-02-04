<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaPlano extends Model
{
    protected $fillable = [
        'empresa_id',
        'loja_id',
        'valor',
        'acrescimo',
        'desconto',
        'valor_total',
        'data_email_vencimento',
        'data_email_reenvio_boleto',
        'data_vencimento',
        'pago_em',
        'atual',
        'baixado_por',
        'ativo',
        'user_id',
        'nome_usuario'
    ];
    /**
     * Salvar
     *
     * @param [type] $dados
     * @return void
     */
    public function salvar($dados){
        $empresaPlano = [];
        $empresaPlano = $this->create($dados);
        return $empresaPlano;
    }
}
