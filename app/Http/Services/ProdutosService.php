<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\User;

use App\Utils\Util;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\DB;

class ProdutosService
{
    public $listaOrdenacao = [
        'nm_produto' => 'Nome',
        'ds_produto' => 'Descrição',
        'vl_produto' => 'Valor'
    ];

    public function __construct()
    {
    }

    public function obterListaInicial(Request $request)
    {
        $produtos = Produto::
                            select([
                                'produtos.*',
                                DB::raw("FORMAT(produtos.vl_produto, 2, 'de_DE') as vlProduto")
                            ])
                            ->where('in_ativo', '=', 1)
                            ->paginate();
        return $produtos;
    }

    public function filtrar(Request $request)
    {
        $dados = $request->all();
        $produtos = Produto::
                            select([
                                'produtos.*',
                                DB::raw("FORMAT(produtos.vl_produto, 2, 'de_DE') as vlProduto")
                            ])
                            ->where($this->filtro($dados))
                            ->orderBy($dados['campo_ordenacao'], $dados['tp_ordem'])
                            ->paginate();
        return $produtos;
    }

    private function filtro($dados){
        $condicao[] = ['produtos.in_ativo', '=', 1];

        extract($dados);

        if(isset($nm_produto) && !empty($nm_produto))
            $condicao[] = ['produtos.nm_produto', 'like', "%$nm_produto%"];

        if(isset($ds_produto) && !empty($ds_produto))
            $condicao[] = ['produtos.ds_produto', 'like', "%$ds_produto%"];

        if(isset($vl_produto) && !empty($vl_produto)){
            $vl_produto = Util::converterRealParaDecimal($vl_produto);
            $condicao[] = ['produtos.vl_produto', 'like', "%$vl_produto%"];
        }

        return $condicao;
    }

    public function salvar(Request $request)
    {
        $dados = $request->all();

        if(isset($dados['id']) && !empty($dados['id'])){
            $this->atualizar($dados, $request);
        }else {
            $this->adicionar($dados, $request);
        }
    }

    private function adicionar($dados, Request $request){
        $produto = new Produto();
        $produto->usuario_id = Auth::user()->id;
        $produto->nm_produto = $dados['nm_produto'];
        $produto->ds_produto = $dados['ds_produto'];
        $produto->vl_produto = Util::converterRealParaDecimal($dados['vl_produto']);

        if(isset($dados['foto']) && !empty($dados['foto']))
            $produto->foto = self::uploadProdutoFoto($request);

        $produto->in_ativo = 1;
        $produto->save();
    }

    private function atualizar($dados, Request $request){
        $produto = Produto::find($dados['id']);
        $produto->nm_produto = $dados['nm_produto'];
        $produto->ds_produto = $dados['ds_produto'];
        $produto->vl_produto = Util::converterRealParaDecimal($dados['vl_produto']);

        if(isset($dados['foto']) && !empty($dados['foto']))
            $produto->foto = self::uploadProdutoFoto($request);

        $produto->save();
    }

    public function inativar($id){
        $produto = Produto::find($id);
        $produto->in_ativo = 0;
        $produto->save();
    }

    public function inativarProdutosMarcados(Request $request)
    {
        if(!empty($request->input('ids'))){
            $ids = $request->input('ids');
            foreach($ids as $id){
                $this->inativar($id);
            }
        }
    }

    public function obterPorId($id)
    {
        return Produto::
                        select([
                            'produtos.*',
                            DB::raw("FORMAT(produtos.vl_produto, 2, 'de_DE') as vlProduto")
                        ])
                        ->find($id);
    }

    private static function uploadProdutoFoto(Request $request){
        try{
            if($request->hasFile('foto')){
                #- recupero a arquivo
                $img = $request->file('foto');
                #- atribuo um nome único para o arquivo
                $nomeArq = time() . '.' . $img->getClientOriginalExtension();

                /*
                    Verifico se a imagem tem dimensão maior que 700px de largura.
                    Caso positivo eu faço a compressão do arquivo para que fique no máximo 700px de largura e com a altura relativa.
                */
                $img = Image::make($img)->heighten(700);
                $img = Image::make($img)->heighten(700, function ($constraint) {
                    $constraint->upsize();
                });
                #- -----------------------------------------------------------
    
                #- salvo o arquivo físico
                $img->save(public_path('/arquivos_gerados') . '/' . $nomeArq);

                #- retorno o nome do arquivo
                return $nomeArq;
            }
            return null;
        }catch(ErrorException $e){
            return null;
        }
    }

    public function obterTodos()
    {
        return Produto::where('in_ativo', '=', 1)->orderBy('nm_produto', 'asc')->get();
    }

    public function qtdTotalRegistros()
    {
        return Produto::where('in_ativo', '=', 1)->count();
    }
}