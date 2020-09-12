<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    protected $fillable = ['nome_produto', 'descricao_produto'];
    public function clientes()
    {
        return $this->belongsToMany('App\Cliente', 'pedidos');
    }
    /**
     * insere o Produto 
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function inserirProduto($produto)
    {
        $res=   $this->firstOrCreate([
            'nome_produto' => $produto['nome_produto'],
            'descricao_produto' => $produto['descricao_produto']
        ]);
        return  $res;
    }

    /**
     * altera o Produto 
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function alterarProduto($id, $dados)
    {
        $produto =  $this->find($id);
        if (empty($produto)) {
            return false;
        }
        $res = $produto->update($dados->all());
        return $res;
    }

    /**
     * lista o Produto 
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function findListarProduto($id)
    {
        $res =  $this->find($id);
        return $res;
    }

    /**
     * listar o Produto 
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */

    public function listarProduto()
    {
        $produto = Produto::select([
            'produtos.id',
            'produtos.nome_produto',
            'produtos.descricao_produto'
        ])->get();
        return $produto;
    }
}
