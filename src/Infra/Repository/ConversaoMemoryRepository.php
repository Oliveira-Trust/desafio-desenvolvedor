<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Infra\Repository;

use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Entity\Conversao;
use OT\ConversorMoedas\Domain\Exceptions\ConversaoNotFoundException;
use OT\ConversorMoedas\Domain\Exceptions\MoedaNotFoundException;
use OT\ConversorMoedas\Domain\Exceptions\TaxaConversaoNotFoundException;
use OT\ConversorMoedas\Domain\Repository\IConversaoRepository;
use OT\ConversorMoedas\Domain\Shared\BaseEntity;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TaxaConversao;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\TipoMoeda;
use OT\ConversorMoedas\Domain\Shared\ValuesObject\ValorCompra;

class ConversaoMemoryRepository implements IConversaoRepository
{
    private static int $sequence = 0;

    private static Collection $lista;

    private static Collection $listaTaxas;

    private static Collection $listaMoedas;

    public function __construct()
    {
        self::$lista = new Collection();
        self::$listaTaxas = new Collection();
        self::$listaMoedas = new Collection();
        //$this->populaDados();
        $this->populaDadosTaxas();
        $this->populaDadosMoedas();
    }

    public function fetchAll(): Collection
    {
        return self::$lista;
    }

    public function findByID(string $ID): BaseEntity
    {
        $filtered = self::$lista->filter(function ($value) use ($ID) {
            return $value->getID()->toString() == $ID;
        });
        $entity = $filtered->first();

        if (! $entity) {
            throw new ConversaoNotFoundException();
        }

        return $entity;
    }

    public function findTaxaConversaoByValor(float|ValorCompra $valor): TaxaConversao
    {
        $valorBusca = ($valor instanceof ValorCompra) ? $valor->getValue() : $valor;

        $filtered = self::$listaTaxas->filter(function ($value) use ($valorBusca) {
            return $valorBusca >= $value->getValorMin() && $valorBusca <= $value->getValorMax();
        });

        $taxa = $filtered->first();

        if (! $taxa) {
            throw new TaxaConversaoNotFoundException();
        }

        return $taxa;
    }

    public function findMoedaBySigla(string $sigla): TipoMoeda
    {
        $filtered = self::$listaMoedas->filter(function ($value) use ($sigla) {
            return $value->getSigla() == $sigla;
        });

        $moeda = $filtered->first();

        if (! $moeda) {
            throw new MoedaNotFoundException();
        }

        return $moeda;
    }

    public function listAllMoedas(): Collection
    {
        return self::$listaMoedas;
    }

    public function create(Conversao $conversao): void
    {
        self::$lista->add($conversao);
    }

    public function listAll(): Collection
    {
        return self::$lista;
    }

    private function populaDadosMoedas()
    {
        self::$listaMoedas->add(new TipoMoeda('BRL', 'Real Brasileiro'));
        self::$listaMoedas->add(new TipoMoeda('USD', 'Dólar Americano'));
        self::$listaMoedas->add(new TipoMoeda('CAD', 'Dólar Canadense'));
        self::$listaMoedas->add(new TipoMoeda('EUR', 'Euro'));
    }

    private function populaDadosTaxas()
    {
        self::$listaTaxas->add(new TaxaConversao(2, 0.1, 3000));
        self::$listaTaxas->add(new TaxaConversao(1, 3000.01, 1000000));
    }
}
