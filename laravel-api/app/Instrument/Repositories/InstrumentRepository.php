<?php

declare(strict_types=1);

namespace App\Instrument\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Instrument\Interfaces\InstrumentRepositoryInterface;
use App\Instrument\Models\Instrument;

class InstrumentRepository extends BaseRepository implements InstrumentRepositoryInterface
{
    protected string $model = Instrument::class;
}
