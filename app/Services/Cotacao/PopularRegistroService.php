<?php


namespace App\Services\Cotacao;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotacao\CotacaoTaxa;
use App\Models\Cotacao\CotacaoTaxaRange;
use App\Models\Cotacao\TipoCobranca;
use App\Models\Dominio\DominioItem;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PopularRegistroService
{

    public function __construct()
    {
    }

    public function createUsers(){
        DB::table('users')
            ->insert([
                'name' => 'Admin',
                'email' => 'linkhashimoto@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make(1234),
            ]);
    }

    public function createTiposCobrancas(){
        DB::table('tipos_cobrancas')
            ->insert([
                'nom_tipo_cobranca' => 'Boleto',
                'ind_status' => 1,
            ]);

        DB::table('tipos_cobrancas')            
            ->insert([
                'nom_tipo_cobranca' => 'Cartão de Crédito',
                'ind_status' => 1,
            ]);
    }

    public function createDominios(){
        DB::table('dominios')
            ->insert([
                'id' => 'ind_status',
                'dsc_dominio' => 'Status'
            ]); 

        $indStatus = DB::table('dominios')->where('id', 'ind_status')->first();

        DB::table('dominios_itens')
            ->insert([
                'dominio_id' => $indStatus->id,
                'dsc_dominio_item' => 'Ativo',
                'val_dominio_item' => 1
            ]);

        DB::table('dominios_itens')
            ->insert([
                'dominio_id' => $indStatus->id,
                'dsc_dominio_item' => 'Inativo',
                'val_dominio_item' => 2
            ]);
    }    
    
    public function createCotacoesTaxas(){
        $tipoBoleto = DB::table('tipos_cobrancas')
            ->whereRaw('upper(nom_tipo_cobranca) = upper(?)', 'Boleto')
            ->first();

        $tipoCartaoCredito = DB::table('tipos_cobrancas')
            ->whereRaw('upper(nom_tipo_cobranca) = upper(?)', 'Cartão de Crédito')
            ->first();

        DB::table('cotacoes_taxas')
            ->insert([
                'tipo_cobranca_id' => $tipoBoleto->id,
                'dsc_cotacao_taxa' => "Para pagamentos em {$tipoBoleto->nom_tipo_cobranca}, Taxa de 1,45%",
                'per_cotacao_taxa' => 1.45,
                'ind_status' => 1,
            ]);

        DB::table('cotacoes_taxas')
            ->insert([
                'tipo_cobranca_id' => $tipoCartaoCredito->id,
                'dsc_cotacao_taxa' => "Para pagamentos em {$tipoCartaoCredito->nom_tipo_cobranca}, Taxa de 7,63%",
                'per_cotacao_taxa' => 7.63,
                'ind_status' => 1
            ]);

        $cotacaoTaxaId = DB::table('cotacoes_taxas')
            ->insertGetId([
                'tipo_cobranca_id' => $tipoBoleto->id,
                'dsc_cotacao_taxa' => "Taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 ({$tipoBoleto->nom_tipo_cobranca})",
                'per_cotacao_taxa' => 2,
                'ind_status' => 1,
            ]);
        
        DB::table('cotacoes_taxas_ranges')
            ->insert([
                'cotacao_taxa_id' => $cotacaoTaxaId,
                'val_minimo' => 3000.00,
                'val_maximo' => null,
                'ind_status' => 1,
            ]);

        $cotacaoTaxaId = DB::table('cotacoes_taxas')
            ->insertGetId([
                'tipo_cobranca_id' => $tipoCartaoCredito->id,
                'dsc_cotacao_taxa' => "Taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 ({$tipoCartaoCredito->nom_tipo_cobranca})",
                'per_cotacao_taxa' => 2,
                'ind_status' => 1,
            ]);

        DB::table('cotacoes_taxas_ranges')
            ->insert([
                'cotacao_taxa_id' => $cotacaoTaxaId,
                'val_minimo' => 3000.00,
                'val_maximo' => null,
                'ind_status' => 1,
            ]);

        $cotacaoTaxaId = DB::table('cotacoes_taxas')
            ->insertGetId([
                'tipo_cobranca_id' => $tipoBoleto->id,
                'dsc_cotacao_taxa' => "Taxa de 1% para valores maiores que R$ 3.000,00 ({$tipoBoleto->nom_tipo_cobranca})",
                'per_cotacao_taxa' => 1,
                'ind_status' => 1,
            ]);

        DB::table('cotacoes_taxas_ranges')
            ->insert([
                'cotacao_taxa_id' => $cotacaoTaxaId,
                'val_minimo' => null,
                'val_maximo' => 3000.01,
                'ind_status' => 1,
            ]);            

        $cotacaoTaxaId = DB::table('cotacoes_taxas')
            ->insertGetId([
                'tipo_cobranca_id' => $tipoCartaoCredito->id,
                'dsc_cotacao_taxa' => "Taxa de 1% para valores maiores que R$ 3.000,00 ({$tipoCartaoCredito->nom_tipo_cobranca})",
                'per_cotacao_taxa' => 1,
                'ind_status' => 1,
            ]);

        DB::table('cotacoes_taxas_ranges')
            ->insert([
                'cotacao_taxa_id' => $cotacaoTaxaId,
                'val_minimo' => null,
                'val_maximo' => 3000.01,
                'ind_status' => 1,
            ]);
    }

    public function generate(){
        DB::beginTransaction();
        try {
            $this->createUsers();
            $this->createDominios();
            $this->createTiposCobrancas();
            $this->createCotacoesTaxas();
            DB::commit();
        } catch(\Exception $e){
            DB::rollback();
            dd($e->getMessage());
        }
    }

}
