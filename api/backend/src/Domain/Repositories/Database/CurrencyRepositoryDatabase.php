<?php
declare(strict_types=1);

namespace App\Domain\Repositories\Database;

use App\Domain\Contracts\Repository\CurrencyRepositoryInterface;
use App\Domain\Entities\Currency;
use Doctrine\ORM\EntityManager;

class CurrencyRepositoryDatabase extends \Doctrine\ORM\EntityRepository implements CurrencyRepositoryInterface
{
    protected $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getById(int $id):? Currency
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Currency u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        return $query->getOneOrNullResult();
    }
    public function getAll(): array
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Currency u');
        return $query->getResult();
    }
    public function getByCurrencyCode(string $code):? Currency
    {
        $arrCodes = explode('-', $code);
        $dql = "SELECT u FROM App\Domain\Entities\Currency u WHERE UPPER(u.code) = :code AND UPPER(u.codein) = :codein";
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter('code',   $arrCodes[0] );
        $query->setParameter('codein', $arrCodes[1] );
        $currency = $query->getOneOrNullResult();
        return $currency;
    }
    public function save(Currency $currency): Currency
    {
        $this->entityManager->persist($currency);
        $this->entityManager->flush();
        return $currency;
    }
}
