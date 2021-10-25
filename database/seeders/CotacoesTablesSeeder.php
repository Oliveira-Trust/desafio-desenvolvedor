<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CotacoesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createCotacoesTaxas();
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

}
