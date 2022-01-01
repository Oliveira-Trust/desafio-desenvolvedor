<?php
declare(strict_types=1);

namespace App\Domain\Contracts\Repository;

use App\Domain\Entities\TaxTransaction;

interface TaxTransactionRepositoryInterface
{
    public function getTaxTransaction():TaxTransaction;
    public function save(TaxTransaction $taxTransaction): TaxTransaction;
}