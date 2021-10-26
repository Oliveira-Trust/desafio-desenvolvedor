<?php


namespace App\Services\User;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotacao\CotacaoTaxa;
use App\Models\Cotacao\CotacaoTaxaRange;
use App\Models\UserCotacao;
use App\Services\User\UserCotacaoTaxaService;

class UserCotacaoService
{
    protected UserCotacaoTaxaService $userCotacaoTaxaService;

    public function __construct(
        UserCotacaoTaxaService $userCotacaoTaxaService
    ){
        $this->userCotacaoTaxaService = $userCotacaoTaxaService;
    }

    public function get(){
        return UserCotacao::with('tipoCobranca')
            ->where('user_id', auth()->user()->id)
            ->get();
    }

    public function show(int $id){
        return UserCotacao::query()
            ->where('user_id', auth()->user()->id)
            ->find($id);
    }

    public function storeUserCotacao(array $inputs){
        return UserCotacao::create($inputs);
    }

    public function updateById(array $inputs, int $id){
        return UserCotacao::query()
            ->find($id)
            ->update($inputs);
    }

    public function destroyById(int $id){
        return UserCotacao::find($id)->delete();
    }

    public function storeUserCotacoesTaxas(int $userCotacaoId, int $tipoCobrancaId){
        $cotacoesTaxasPorTipoCobranca = CotacaoTaxa::from('cotacoes_taxas as a')
            ->where('a.tipo_cobranca_id', $tipoCobrancaId)
            ->where('a.ind_status', 1)
            ->get();
                
        foreach($cotacoesTaxasPorTipoCobranca as $cotacaoTaxa){
            $this->userCotacaoTaxaService->store([
                'user_cotacao_id' => $userCotacaoId,
                'cotacao_taxa_id' => $cotacaoTaxa->id
            ]);
        }
    }

    public function calculaCotacaoTaxas(int $userCotacaoId){
        $userCotacao = UserCotacao::find($userCotacaoId);
        $valQuantia = $userCotacao->val_quantia;

        return $valQuantia - collect([
            $this->calculaCotacaoTaxaSemRange($userCotacaoId)->sum(), 
            $this->calculaCotacaoTaxaComRange($userCotacaoId)->sum()
        ])->sum();
    }

    public function calculaCotacaoTaxaSemRange(int $userCotacaoId){
        $novoValor = collect(
            $this->getCotacaoSemRange($userCotacaoId)
        )
            ->map(function($item){
                return $item->val_taxado;
            });

        return $novoValor;
    }

    //Range
    public function calculaCotacaoTaxaComRange($userCotacaoId){
        $taxaValorConversao = collect(
            $this->getcotacaoComRange($userCotacaoId)
        )
            ->map(function($item){
                return $item->val_taxado;
            });

        return $taxaValorConversao;
    }

    public function getCotacaoSemRange($userCotacaoId){
        $cotacaoTaxaSemRange = UserCotacao::from('users_cotacoes as a')
            ->join('users_cotacoes_taxas as b', 'b.user_cotacao_id', 'a.id')
            ->join('cotacoes_taxas as c', 'b.cotacao_taxa_id', 'c.id')
            ->leftJoin('cotacoes_taxas_ranges as d', 'c.id', 'd.cotacao_taxa_id')
            ->where('b.user_cotacao_id', $userCotacaoId)
            ->where('c.ind_status', 1)
            ->whereNull('d.cotacao_taxa_id')
            ->get([
                'a.val_quantia',
                'c.dsc_cotacao_taxa',
                'c.per_cotacao_taxa'
            ]);

        return collect($cotacaoTaxaSemRange)
            ->map(function($item){
                $item->val_taxado = $item->val_quantia * ($item->per_cotacao_taxa / 100);

                return $item;
            });
    }

    public function getCotacaoComRange($userCotacaoId){
        $cotacaoComRange = UserCotacao::from('users_cotacoes as a')
            ->join('users_cotacoes_taxas as b', 'b.user_cotacao_id', 'a.id')
            ->join('cotacoes_taxas as c', 'c.id', 'b.cotacao_taxa_id')
            ->join('cotacoes_taxas_ranges as d', 'd.cotacao_taxa_id', 'c.id')
            ->where('b.user_cotacao_id', $userCotacaoId)
            ->where('c.ind_status', 1)
            ->select([
                'a.val_quantia',
                'd.val_minimo',
                'd.val_maximo',
                'c.dsc_cotacao_taxa',
                'c.per_cotacao_taxa'
            ])
            ->get();

        return collect($cotacaoComRange)
            ->reject(function($item){
                $valQuantia = $item->val_quantia;

                if(
                    ($valQuantia <= $item->val_minimo && is_null($item->val_maximo) && !is_null($item->val_minimo)) ||
                    ($valQuantia >= $item->val_maximo && is_null($item->val_minimo) && !is_null($item->val_maximo)) ||
                    ($valQuantia >= $item->val_minimo && $valQuantia <= $item->val_maximo && !is_null($item->val_maximo) && !is_null($item->val_minimo))
                ){
                    return false;
                }

                return true;
            })
            ->map(function($item){
                $item->val_taxado = $item->val_quantia * ($item->per_cotacao_taxa / 100);

                return $item;
            })
            ->values();
    }
}
