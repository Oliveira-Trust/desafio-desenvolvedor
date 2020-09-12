<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    protected $fillable = ['nome', 'data_nascimento', 'cpf'];

    public function produtos()
    {
        return $this->belongsToMany('App\Produto', 'pedidos');
    }



    /**
     * inserer o Cliente 
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function inserirCliente($cliente)
    {
        $data = Carbon::createFromFormat('d/m/Y', $cliente['data_nascimento'])->format('Y-m-d');
        $cpf = preg_replace('/[^0-9]/', '',$cliente['cpf']);
        $res = $this->firstOrCreate([
            'nome' => $cliente['nome'],
            'cpf' => $cpf,
            'data_nascimento' => $data
        ]);

        return  $res;
    }


    /**
     * alterar o Cliente 
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */

    public function alterarCliente($id, $dados)
    {
        $cliente =  $this->find($id);
        if (empty($cliente)) {
            return false;
        }
        $dados['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $dados['data_nascimento'])->format('Y-m-d');
        $dados['cpf'] = preg_replace('/[^0-9]/', '',$dados['cpf']);
        $res = $cliente->update($dados->all());
        return $res;
    }

    /**
     * listar o Cliente 
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */

    public function findListarCliente($id)
    {
        $res =  $this->find($id);
        return $res;
    }

    /**
     * listar o Cliente 
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */

    public function listarCliente()
    {
        $cliente = Cliente::select([
            'clientes.id',
            'clientes.nome',
            'clientes.cpf',
            DB::raw("DATE_FORMAT(clientes.data_nascimento,'%d/%m/%Y') as data_nascimento")
        ])->get();
      
        return $cliente;
    }
}
