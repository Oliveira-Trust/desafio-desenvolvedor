<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OT\ConversorMoedas\Application\UseCases\Conversor\ConverterValorUC;
use OT\ConversorMoedas\Application\UseCases\Conversor\DTO\ConverterValorInputDTO;
use OT\ConversorMoedas\Infra\Api\Awesomeapi\CotacoesMoedas\CotacaoMoedaService;
use OT\ConversorMoedas\Infra\Repository\ConversaoEloquentRepository;
use OT\ConversorMoedas\Infra\Repository\FormaPagamentoEloquentRepository;

class ConversorMoeda extends Command
{
    protected $signature = 'converter-moeda';

    protected $description = 'Conversor de moedas';

    public function __construct(
        private FormaPagamentoEloquentRepository $repositoryFormaPgto,
        private ConversaoEloquentRepository $repositoryConversao,
        private CotacaoMoedaService $cotacaoService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->newLine();
        $this->comment('############# CONVERSOR DE MOEDAS ##############');
        $this->line('🎉🎉 Bem vindo/a à nossa cotação de moedas 🧮💸');
        $this->newLine();

        $valor = $this->ask('Quanto deseja comprar (Em R$ BRL)? Ex: 1.550,00');
        $valorCompra = $this->limpaFormatacao($valor);

        while ($valorCompra < 1000 || $valorCompra > 100000) {
            $this->error('Desculpa, o valor precisa ser entre 1.000,00 e 100.000,00');
            $valor = $this->ask('Digite um novo valor (Em R$ BRL)? Ex: 1.550,00');
            $valorCompra = $this->limpaFormatacao($valor);
        }
        //$this->line($valorCompra);

        $moedaDestino = strtoupper($this->anticipate('Para qual moeda deseja converter? USD, EUR, ou CAD', ['USD', 'EUR', 'CAD']));
        while (! in_array($moedaDestino, ['USD', 'EUR', 'CAD'])) {
            $this->error('Desculpa, no momento estamos trabalhando apenas com as moedas USD, EUR e CAD.');
            $moedaDestino = strtoupper($this->anticipate('Informe novamente para qual moeda deseja converter', ['USD', 'EUR', 'CAD']));
        }

        $formaPagto = $this->ask('Como deseja pagar, digite 1 para Boleto ou 2 para Cartão de Crédito');
        while ($formaPagto != 1 && $formaPagto != 2) {
            $this->error('Desculpa, digite apenas 1 ou 2. 1 para Boleto ou 2 para Cartão de Crédito');
            $formaPagto = $this->ask('Como deseja pagar?');
        }

        $this->comment('⏳⏳ Aguarde enquanto efetuamos a conversão...');

        try {
            $siglaPagto = ($formaPagto == 1) ? 'BLT' : 'CC';
            $input = new ConverterValorInputDTO('BRL', $moedaDestino, $valorCompra, $siglaPagto);

            $uc = new ConverterValorUC($input, $this->repositoryFormaPgto, $this->repositoryConversao, $this->cotacaoService->cotacao());
            $output = $uc->execute();

            $this->table(
                ['Moeda Comprada', 'Valor comprado', 'Valor moeda Destino', 'Tx de conversão', 'Forma Pagto', 'Tx forma pagto', 'Saldo p/ conversão'],
                [[$output->destino, round($output->valorConvertido, 2), $output->valorCotacao, round($output->taxaConversao, 2), $output->nomeFormaPagamento, round($output->taxaPagamento, 2), round($output->saldoParaConversao, 2)]]
            );

            return Command::SUCCESS;
        } catch (\DomainException $d) {
            $this->error('FALHA NO PROCESSAMENTO DAS INFORMAÇÕES: '.$d->getMessage());

            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('FALHA NO PROCESSAMENTO DAS INFORMAÇÕES: '.$e->getMessage());

            return Command::FAILURE;
        }
    }

    private function limpaFormatacao($valor)
    {
        $str = str_replace('.', '', $valor); // remove o ponto

        return str_replace(',', '.', $str); // troca a vírgula por ponto
    }
}
